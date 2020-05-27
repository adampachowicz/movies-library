## Jak uruchomić

1. Plik `.env`

    Należy podać dostępy do bazy danych w polach
    np.
    
    `DB_CONNECTION=mysql`<br />
    `DB_HOST=127.0.0.1`<br />
    `DB_PORT=3306`<br />
    `DB_DATABASE=movies_library`<br />
    `DB_USERNAME=root`<br />
    `DB_PASSWORD=root`
 
 2. Composer
 
    `composer install`
 
 3. Migracja bazy danych
 
    `php artisan migrate`
 
 4. Jeżeli chcemy uzupełnić bazę fakowymi danymi
 
    `php artisan db:seed`
 
 5. Instalacja passport klienta
 
    `php artisan passport:install --client`
    
 6. Uruchomianie
 
    `php artisan serve`
    
 
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
 
   Aplikacja posiada 5 endpointów głównych które pozwalają na dodawanie, listowanie, usuwanie, edycję oraz szukanie po tytule
   
   ### Wylogowanie
   
   `GET` `logout`
   
   Headers `access_token` zwrócony wczasie logowania
   
   
   ### Użytkownik
   
   Informacje na temat użytkownika musimy być zalogowani tokenem
   
   `GET` `user`
   
 
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
   
   
   
   
