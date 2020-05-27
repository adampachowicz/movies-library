## Jak uruchomić

1. Plik `.env.example` skopiować i utworzyć `.env` a w nim

    należy podać dostępy do bazy danych w polach
    np.
    
    `DB_CONNECTION=mysql`<br />
    `DB_HOST=127.0.0.1`<br />
    `DB_PORT=3306`<br />
    `DB_DATABASE=movies_library`<br />
    `DB_USERNAME=root`<br />
    `DB_PASSWORD=root`
 
 2. Composer
 
    `composer install`
    
 3. Generowanie klucza
 
    `php artisan key:generate`
 
 4. Migracja bazy danych
 
    `php artisan migrate`

  5. Utworzenie folderu

      w folderze public utworzenie folderu `files` 

 6. Jeżeli chcemy uzupełnić bazę fake- owymi danymi
 
    `php artisan db:seed`
 
 7. Instalacja passport klienta

   `php artisan passport:install`
    
 8. Uruchomianie
 
    `php artisan serve`

    INFORMACYJNIE !!!
    W przypadku błędu z `fruitcake/laravel-cors`

   `composer remove fruitcake/laravel-cors`
   `composer require asm89/stack-cors "2.0.0"`
   `composer require fruitcake/laravel-cors "2.0.0"`

    `https://github.com/fruitcake/laravel-cors/issues/458`
    
 
 ## O aplikacji
 
   ## Korzystanie z API:
    
   ### Rejestracja użytkownika
    
    `POST` `/register`
    
   Klucz | Wartość
   ------|--------
   `name`| Nazwa
   `email` | Unikalny adres email
   `password` | Hasło
   `c_password` | Potwierdzenie hasła
     
   ### Logowanie
    
    `POST` `/login`
    
   Klucz | Wartość
   ------|--------
   `email` | Adres email
   `password` | Hasło
    
   W odpowiedzi otrzymamy `access_token`
   
   ### Wylogowanie
      
    `GET` `logout`
      
   Headers `access_token` zwrócony wczasie logowania
      
      
   ### Użytkownik
      
   Informacje na temat użytkownika musimy być zalogowani tokenem
      
    `GET` `user`
 
   Aplikacja posiada 5 endpointów głównych które pozwalają na dodawanie, listowanie, usuwanie, edycję oraz szukanie po tytule
    
 ### Dodawanie filmu
 
  `POST` `/movies`
 
 Klucz | Wartość
 ------|--------
 `title`| Tytuł filmu - string, min:3, max:100
 `description`| Opis filmu - string, min:3, max:10000
 `category`| Kategoria - string, min:3, max:100
 `made_in`| Kraj produkcji - string, min:3, max:100
 `label`| Okładka plik -image, max:2048
 
  ### Edycja
      
  `PUT` `/movies/{id}`
   
  `id` = Unikalny numer id zwrócony podczas dodawania filmu
   
 Klucz | Wartość
 ------|--------
 `title`| Tytuł filmu - string, min:3, max:100
 `description`| Opis filmu - string, min:3, max:10000
 `category`| Kategoria - string, min:3, max:100
 `made_in`| Kraj produkcji - string, min:3, max:100
 `label`| Okładka plik -image, max:2048
    
  ### Usuwanie
  
  `DELETE` `/movies/{id}`
  
  `id` = Unikalny numer id zwrócony podczas dodawania filmu
   
   ### Listowanie
   
   Endpoint zwraca listę dodanych filmów
   
   `GET` `/movies`
   
   ### Szukaj po tytule
   
   Endpoint zwraca wynik listy szukania po tytule
   
   `POST` `movies/find`
   
   Klucz | Wartość
   ------|--------
   `title` | Tytuł filmu
   
   
   
   
