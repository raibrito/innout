<?php
class User extends Model {
    protected static $tableName = 'users';
    protected static $columns = [
        'id',
        'name',
        'password',
        'email',
        'start_date',
        'end_date',
        'is_admin'
    ];

    //qtde de usuários ativos no sistema
    public static function getActiveUsersCount() {
        return static::getCount(['raw' => 'end_date IS NULL']);
    }

    //metodo responsável por inserir usuário
    public function insert() {
        $this->validate();
        $this->is_admin = $this->is_admin ? 1 : 0;
        if(!$this->end_date) $this->end_date = null;
        return parent::insert();
    }

    //alterar usuário
    public function update() {
        $this->validate();
        $this->is_admin = $this->is_admin ? 1 : 0;
        if(!$this->end_date) $this->end_date = null;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::update();
    }

    //validações de usuários
    private function validate(){
        $errors = [];

        //se o nome do funcionário/usuário n estiver preenchido
        if(!$this->name) {
            $errors['name'] = 'Campo abrigatório.';
        }

        //se o email do funcionário/usuário n estiver preenchido
        if (!$this->email){
            $errors['email'] = 'E-mail é um campo obrigatório';
        }elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Endereço de e-mail inválido';
        }

        //se a data de admissão do funcionário/usuário n estiver preenchida
        if (!$this->start_date){
            $errors['start_date'] = 'Data de admissão é um campo obrigatório';
        }elseif (!DateTime::createFromFormat('Y-m-d', $this->start_date)){
            $errors['start_date'] = 'Padrão inválido';

        }

        //se padrão da data de desligamento estiver errada
        if ($this->end_date && !DateTime::createFromFormat('Y-m-d', $this->end_date)){
            $errors['end_date'] = 'Padrão inválido';
        }

        //validação senha
        if (!$this->password){
            $errors['password'] = 'Senha é um campo obrigatório';
        }

        //validação confirmação de senha
        if (!$this->confirm_password){
            $errors['confirm_password'] = 'Confirmação obrigatória';
        }

        //verificar se a senha está igual a confirmação de senha
        if ($this->password && $this->confirm_password && $this->password !== $this->confirm_password){
            $errors['password'] = 'As senhas não são iguais';
            $errors['confirm_password'] = 'As senhas não são iguais';
        }

        //se for maior que 0, lançar exception
        if (count($errors) >0){
            throw new ValidationException($errors);
        }
    }
}
