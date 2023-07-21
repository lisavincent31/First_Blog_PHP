<?php 

namespace App\Validation;

class Validator {

    private $data;
    private $errors;

    public function __construct(array $data) {
        $this->data = $data;
    }

    // specific function to validate a form field
    public function validate(array $rules): ?array
    {
        foreach($rules as $name => $rulesArray) {
            if(array_key_exists($name, $this->data)) {
                foreach($rulesArray as $rule) {
                    switch($rule) {
                        case 'required':
                            $this->required($name, $this->data[$name]);
                            break;
                        case substr($rule, 0, 3) === 'min:':
                            $this->min($name, $this->data[$name], $rule);
                            break;
                        case 'html':
                            $this->html($name, $this->data[$name]);
                            break;
                        default:
                            break;
                    }
                }
            }
        }
        return $this->getErrors();
    }

    // this field is absolutly required
    private function required(string $name, string $value)
    {
        $value = trim($value);

        if(!isset($value) || $value == null || empty($value)){
            $this->errors[$name] = "Le champ {$name} est requis...";
        }
    }

    // This field have a minimum caracters
    private function min(string $name, string $value, string $rule) {
        preg_match_all('/(\d+)/', $rule, $matches);
        $limit = (int) $matches[0][0];

        if(strlen($value) < $limit) {
            $this->errors[$name] = "Le champ {$name} doit comprendre un minimum de {$limit} caractères.";
        }
    }

    private function html(string $name, string $value) {
        $value = htmlspecialchars($value);

        if(preg_match('/[\^£$%&*()}{#~><>,|=+¬-]/', $value)) {
            $this->errors[$name] = "Attention, certains caractères spéciaux ne sont pas accepté pour le champ {$name}.";
        }
    }

    // This function return all the errors
    private function getErrors(): ?array
    {
        return $this->errors;
    }
}

?>