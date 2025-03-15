<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ParticipantsRelationManager extends RelationManager
{
    protected static string $relationship = 'participants';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('fullName')->label('Nome Completo')->required(),
            Forms\Components\TextInput::make('email')->label('E-mail')->email()->required(),
            Forms\Components\TextInput::make('phone')->label('Contacto')->required(),
            Forms\Components\DatePicker::make('dateBorn')->label('Data de Nascimento')->required(),
            Forms\Components\Select::make('sizeTshirt')->label('Tamanho da Camiseta')->required()
                ->options([
                    '8-10' => '8-10',
                    '10-12' => '10-12',
                    'S' => 'S',
                    'M' => 'M',
                    'L' => 'L',
                    'XL' => 'XL',
                    'XXL' => 'XXL',
                ]),
            Forms\Components\TextInput::make('responsableName')->label('Nome do Responsável'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('fullName')->label('Nome')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('email')->label('E-mail')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('phone')->label('Telefone'),
            Tables\Columns\TextColumn::make('dateBorn')->label('Data de Nascimento')->date(),
        ]);
    }
}

