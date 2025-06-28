<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Filament\Resources\BarangResource\RelationManagers\StocksRelationManager;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Collection;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama'),
                TextInput::make('barcode'),
                TextInput::make('satuan'),
                TextInput::make('version')->readOnly(),
                Placeholder::make('total_stock')
                 ->visibleOn('edit', 'view')
                 ->content(fn (Model $record)
                 =>"{$record->totalStock} {$record->satuan}"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama'),
                TextColumn::make('barcode'),
                TextColumn::make('satuan'),
                TextColumn::make('totalStock'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('ganti_nama_barang')
                    ->label('Ganti Nama Barang')
                    ->form([
                        TextInput::make('nama')
                            ->required(),
                    ])
                    ->action(
                        function (Model $record,array $data){
                            $record->update([
                                'nama'=>$data['nama']
                            ]);
                            Notification::make()
                            ->title("Nama Barang berhasil di update")
                            ->info()
                            ->send();
                        }
                    )
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                Tables\Actions\BulkAction::make('bulk_action')
                ->label('Bulk Action')
                ->form([
                    TextInput::make('nama'),
                ])
                ->action(
                    function(Collection $record, array $data) {
                        $namas = [];
                        foreach ($record as $record){
                            $namas[]= $record->nama;
                        }
                        $barangDipilih =  implode(',', $namas);
                        $nama = $data['nama']?? 'User';
                        Notification::make()
                        ->title("{$nama} memilih: {$barangDipilih}")
                        ->info()
                        ->send();
                    }
                ),
            ])

            ->headerActions([
                Tables\Actions\Action::make('header_action')
                ->label('Header Action')
                ->form([
                    TextInput::make('nama')
                        ->required(),
                ])
                ->action(
                    function(array $data){
                        $nama=$data['nama']??'world';
                        Notification::make()
                        ->title("Hello{$nama}")
                        ->info()
                        ->send();
                    }
                ),
            ])

            //
            //relasi stocks)
            ->modifyQueryUsing(fn(Builder $query)
            =>$query->with(['stocks']));
    }

    public static function getRelations(): array
    {
        return [
         RelationManagers\StocksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}