<h1 align="center">

![checklistable logo](https://raw.githubusercontent.com/convenia/checklistable/master/checklist.jpg)
</h1>
<h1 align="center">

# CHECKLISTABLE 

</h1>


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/caa824afe85f4658a27f0432ecfac4ad)](https://www.codacy.com/app/Convenia/checklistable_2?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=convenia/checklistable&amp;utm_campaign=Badge_Grade)
[![Codacy Badge](https://api.codacy.com/project/badge/Coverage/caa824afe85f4658a27f0432ecfac4ad)](https://www.codacy.com/app/Convenia/checklistable_2?utm_source=github.com&utm_medium=referral&utm_content=convenia/checklistable&utm_campaign=Badge_Coverage)
[![GitHub forks](https://img.shields.io/github/forks/convenia/checklistable.svg)](https://github.com/convenia/checklistable/network)
![Dependencies](https://img.shields.io/badge/dependencies-up%20to%20date-brightgreen.svg)
[![GitHub Issues](https://img.shields.io/github/issues/convenia/checklistable.svg)](https://github.com/convenia/checklistable/issues)
![Contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg)
[![License](https://img.shields.io/badge/license-MIT%20License-brightgreen.svg)](https://opensource.org/licenses/MIT)

## Basic Overview

Add checklist in your project associated a any model in yout project


## Install
```bash
composer require convenia/checklistable
```

###  publish migrations
```bash
php artisan vendor:publish --tag="checklistable"
```

###  migrate
```bash
php artisan migrate
```

<br>

## Usage

#### add a trait


```php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Convenia\Checklistable\Traits\ChecklistableTrait;

class ModelClass extends Model
{
    use ChecklistableTrait;    
```

#### Checklist Methods

##### checklist()
```php
// Return ChecklistService Object
ModelClass::checklist($type, $ownerId);  
```

##### checklist()->get()
```php
// Return Checklist Model, if not existe will create it
ModelClass::checklist($type, $ownerId)->get();  
```

#### Question Methods

##### checklist()->questions()
```php
// Return QuestionService Object
ModelClass::checklist($type, $ownerId)
    ->questions();  
```

##### checklist()->questions()->get()
```php
// Return Collection of questions
ModelClass::checklist($type, $ownerId)
    ->questions()
        ->get();  
```

##### checklist()->questions()->fill()
```php
// add and return question in lot (only if empty)
ModelClass::checklist($type, $ownerId)
    ->questions()
    ->fill([]);  
```

##### checklist()->questions()->delete()
```php
// delete one question
ModelClass::checklist($type, $ownerId)
    ->questions()
    ->delete($questionId);  
```

##### checklist()->questions()->add()
```php
// add one question an d return all
ModelClass::checklist($type, $ownerId)
    ->questions()
    ->add([
        'question' => 'What does Marcellus wallace looks like ?'
    ]);  
```

#### Answer Methods

##### checklist()->answer()
```php
// Return QuestionService Object
ModelClass::checklist($type, $ownerId)
    ->answer();  
```

##### checklist()->answer()->get()
```php
// retrive all answers about checklistable, if do not have, fill it
ModelClass::checklist($type, $ownerId)
    ->answer()
    ->get($checklistableId);  
```

##### checklist()->answer()->start()
```php
// fill the answers with the questions
ModelClass::checklist($type, $ownerId)
    ->answer()
    ->start($checklistableId);  
```

##### checklist()->answer()->answer()
```php
// change answer response
ModelClass::checklist($type, $ownerId)
    ->answer()
    ->start($checklistableId, $answerId, $answer = true)
```

## License

Checklistable is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)