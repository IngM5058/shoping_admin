<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('image_url')
                    ->label('รูปภาพ')
                    ->required(),
                TextInput::make('name')
                    ->label('ชื่อ')
                    ->required(),
                TextInput::make('price')
                    ->numeric()
                    ->suffix('บาท')
                    ->label('ราคา')
                    ->required(),
                TextInput::make('stock')
                    ->numeric()
                    ->suffix('ชิ้น')
                    ->label('จำนวนสินค้า')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->label('รูปภาพ')
                    ->circular()
                    ->width(40)
                    ->height(40)
                    ->defaultImageUrl(url('/images/placeholder-product.jpg'))
                    ->tooltip(fn (Product $record): string => "Click to view {$record->name}")
                    ->openUrlInNewTab(),
                TextColumn::make('name')
                    ->label('ชื่อ'),
                TextColumn::make('price')
                    ->numeric(),
                TextColumn::make('category.name')
                    ->label('หมวดหมู่สินค้า'),
                TextColumn::make('stock')
                    ->label('สินค้าคงเหลือ')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
