<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Roles;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;
use Livewire\Component;

class Notes extends Component implements HasForms, HasTable
{

    use InteractsWithForms, InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Tables\Actions\CreateAction::make('create-user')
                    ->label('Create User')
                    ->color('success')
                    ->form([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                ->label('User Name')
                                ->columnSpanFull()
                                ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->label('User Email')
                                    ->email()
                                    ->required(),
                                Forms\Components\TextInput::make('password')
                                    ->label('User Password')
                                    ->password()
                                    ->required(),
                                Forms\Components\Select::make('role')
                                    ->required()
                                    ->options(Roles::all()->pluck('role', 'id'))
                            ])
                    ])
            ])
            ->query(User::query())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('User Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('User Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.role')
                    ->badge()
                    ->label('User Role')
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->form([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                ->label('User Name')
                                ->columnSpanFull()
                                ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->label('User Email')
                                    ->email()
                                    ->required(),
                                Forms\Components\TextInput::make('password')
                                    ->label('User Password')
                                    ->password()
                                    ->required(),
                                Forms\Components\Select::make('role')
                                    ->required()
                                    ->options(Roles::all()->pluck('role', 'id'))
                            ])
                    ]),
                Tables\Actions\EditAction::make()
                    ->color('info')
                    ->form([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                ->label('User Name')
                                ->columnSpanFull()
                                ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->label('User Email')
                                    ->email()
                                    ->required(),
                                Forms\Components\TextInput::make('password')
                                    ->label('User Password')
                                    ->password()
                                    ->required(),
                                Forms\Components\Select::make('role')
                                    ->required()
                                    ->options(Roles::all()->pluck('role', 'id'))
                            ])
                    ]),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                ])
                ->color('info')
            ]);
    }
    public function render()
    {
        return view('livewire.notes');
    }
}
