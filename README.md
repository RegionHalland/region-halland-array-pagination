# Specialfunktion för att skapa pagination i en array

## Hur man använder Region Hallands plugin "region-halland-array-pagination"

Nedan följer instruktioner hur du kan använda pluginet "region-halland-array-pagination".


## Användningsområde

Denna plugin gör att man kan paginera en array. Funktionen håller koll på var i arrayen man är och vilka poster man ska visa


## Installation och aktivering

```sh
A) Hämta pluginen via Git eller läs in det med Composer
B) Installera Region Hallands plugin i Wordpress plugin folder
C) Aktivera pluginet inifrån Wordpress admin
```


## Hämta hem pluginet via Git

```sh
git clone https://github.com/RegionHalland/region-halland-array-pagination.git
```


## Läs in pluginen via composer

Dessa två delar behöver du lägga in i din composer-fil

Repositories = var pluginen är lagrad, i detta fall på github

```sh
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/RegionHalland/region-halland-array-pagination.git"
  },
],
```
Require = anger vilken version av pluginen du vill använda, i detta fall version 1.0.0

OBS! Justera så att du hämtar aktuell version.

```sh
"require": {
  "regionhalland/region-halland-array-pagination": "1.0.0"
},
```


## Hämta ut paginerings-arrayen och placera den i variabeln $myPagination

- Först hämtar man en valfri array
- Därefter anropar man funktionen "get_region_halland_array_pagination()"
- Man anger tre värden, varav endast det först är obligatoriskt
- Antal poster i arrayen, dvs detta kan anges som "count(ARRAY)"
- Hur många poster som ska visas per sida, anges ingenting är default värde 5
- Vilket namn querystringen har, default är "sida"

```sh
@php($myPagination = get_region_halland_array_pagination(count($myPages),5,'sida'))
```


## Exempel på hur paginerings-arrayen kan se ut

- I denna array finns alla uppgifter man behöver för att paginera

```sh
array (size=13)
  'size' => int 5
  'current_page' => int 5
  'antal_items' => int 43
  'total_pages' => int 9
  'start_item' => int 20
  'end_item' => int 25
  'first_page' => int 1
  'prev_page' => int 4
  'next_page' => int 6
  'last_page' => int 9
  'start_number' => int 2
  'end_number' => int 8
  'start_end' => 
    array (size=7)
      0 => 
        array (size=1)
          'number' => int 2
      1 => 
        array (size=1)
          'number' => int 3
      2 => 
        array (size=1)
          'number' => int 4
      3 => 
        array (size=1)
          'number' => int 5
      4 => 
        array (size=1)
          'number' => int 6
      5 => 
        array (size=1)
          'number' => int 7
      6 => 
        array (size=1)
          'number' => int 8
```


## Loopa igenom poster i intervallet

- Om man inte vill hämta arrayen varje gång kan man mellanlagra den i en session
- Notera att man inte stegar igenom arrayen som man gör annars
- Istället stegar man igenom "arrayens index" och anropar värden genom index-numret

```sh
@if(function_exists('get_region_halland_page_children'))
    @php($myPages = get_region_halland_page_children())
    @if(isset($myPages))
        @php($myPagination = get_region_halland_array_pagination(count($myPages),5,'sida'))
        @php($i = $myPagination['start_item'])
        <?php while ($i < $myPagination['end_item']) { ?>
        {{ $myPages[$i]['title'] }}<br>
        {{ $myPages[$i]['content'] }}<br>
        <?php 
			$i++;
			if ($i >= $myPagination['antal_items']) {
				break;
			} 
		}		 
	    ?>
    @endif
@endif
```


## Visa hur många poster det finns och på vilken sida man är

```sh
Det finns {{ $myPagination['antal_items'] }} sidor<br>
Du är på sida {{ $myPagination['current_page'] }} av {{ $myPagination['total_pages'] }}	
```


## Visa sid-navigering

```sh
<span><a href="./?sida={{ $myPagination['first_page'] }}"><<</a></span>
<span><a href="./?sida={{ $myPagination['prev_page'] }}"><</a></span>
  @foreach ($myPagination['start_end'] as $start_end)
    <span>
      @if($myPagination['current_page'] == $start_end['number'])
	    <strong>
	      <a href="./?sida={{ $start_end['number'] }}">{!! $start_end['number'] !!}</a>
	    </strong>
	  @else
	    <a href="./?sida={{ $start_end['number'] }}">{!! $start_end['number'] !!}</a>
	  @endif
	</span>
  @endforeach
<span><a href="./?sida={{ $myPagination['next_page'] }}">></a></span>
<span><a href="./?sida={{ $myPagination['last_page'] }}">>></a></span>
```


## Versionhistorik

### 1.0.0
- Första version