<?php 

class Validation {
	private $passed = false, $errors = [], $db = null;

	public function __construct($pdo) {
		$this->db = $pdo;
	}

	public function check($post, $form_fields = []) {
		foreach ($form_fields as $form_field => $rules) {
			foreach ($rules as $rule => $rule_value) {
				$value = $post[$form_field];

				if($rule == 'required' && empty($value)) {
					$this->addError("{$form_field} is required");
				}
				else {
					switch ($rule) {
						case 'min':
							if (strlen($value) < $rule_value) {
								$this->addError("{$form_field} must be a minimum of {$rule_value} characters");
							}
						break;
						case 'max':
							if (strlen($value) > $rule_value) {
								$this->addError("{$form_field} must be a maximum of {$rule_value} characters");
							}
						break;

						/*case 'unique': 
							$check = $this->db->get($rule_value, [$item, '=', $value]);
							if ($check->count()) {
								$this->addError("{$item} already exists");
							}

						break;*/
						
					}
				}
			}
		}

		if(empty($this->errors)) {
			$this->passed = true;
		}

		return $this;
	}

	public function addError($error) {
		$this->errors[] = $error;
	}

	public function errors() {
		return $this->errors;
	}

	public function passed() {
		return $this->passed;
	}
	


}

 ?>