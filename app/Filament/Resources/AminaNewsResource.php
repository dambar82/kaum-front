<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AminaNewsResource\Pages;
use App\Models\News;
use App\Models\Project;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AminaNewsResource extends Resource
{
    protected static ?string $navigationGroup = 'Amina';
    protected static ?string $pluralLabel = 'Новости';
    protected static ?string $navigationLabel = 'Новости';

    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                Select::make('project_id')
//                    ->label('Проект')
//                    ->options(Project::all()->pluck('name', 'id')->toArray())
//                    ->required(),
//                TextInput::make('title')
//                    ->label('Название'),
//                FileUpload::make('images')
//                    ->label('Фотографии')
//                    ->multiple()
//                    ->directory('amina/news'),
//                RichEditor::make('content')
//                    ->toolbarButtons([
//                        'attachFiles',
//                        'blockquote',
//                        'bold',
//                        'bulletList',
//                        'codeBlock',
//                        'h2',
//                        'h3',
//                        'italic',
//                        'link',
//                        'orderedList',
//                        'redo',
//                        'strike',
//                        'underline',
//                        'undo',
//                    ])
//                    ->label('Текст новости')
//                    ->columnSpanFull(),
//                DatePicker::make('date')
//                    ->label('Дата'),
//                Checkbox::make('active')
//                    ->label('Новость активна')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('projects.name')
                    ->sortable(query: function (Builder $query): Builder
                    {
                        return $query
                            ->where('project_id', '=', 1);
                    })
                    ->label('Проект'),
                TextColumn::make('title')
                    ->label('Название'),
                ImageColumn::make('images')
                    ->label('Фотографии')
                    ->square(),
                TextColumn::make('date')
                    ->label('Дата'),
                IconColumn::make('active')
                    ->boolean()
                    ->label('Новость активна')
            ])
            ->persistSortInSession()
            ->filters([
                //
            ])
            ->actions([
              //  Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListAminaNews::route('/'),
            'create' => Pages\CreateAminaNews::route('/create'),
            'edit' => Pages\EditAminaNews::route('/{record}/edit'),
        ];
    }
}
