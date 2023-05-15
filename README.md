<h1 align="center" style='color:red'><b>Datapolo</b></h1>



---

<details>
  <summary>Content 📝</summary>
  <ol>
    <li><a href="#objective">Objective</a></li>
    <li><a href="#about-the-project">About the project</a></li>
    <li><a href="#deploy-🚀">Deploy</a></li>
    <li><a href="#stack">Stack</a></li>
    <li><a href="#e-r-diagram">E-R Diagram</a></li>
    <li><a href="#local-instalation">Local instalation</a></li>
    <li><a href="#endpoints">Endpoints</a></li>
    <li><a href="#future-features">Future features</a></li>
    <li><a href="#contributions">Contributions</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#webgraphy">Webgraphy</a></li>
    <li><a href="#development">Development</a></li>
    <li><a href="#special-thanks">Special thanks</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

---

## Objective

---
This project belongs to the last one made for GeekHubs Academy and the goal is to make a FullStack aplication that have at least certain types of relations between the tables of the data base (1:N and N,N). 

## About the project
Decidí crear una aplicación web para ayudar a los amantes del gimnasio, que les permitiría crear y realizar un seguimiento de nuevas rutinas para sus ejercicios diarios. He visto muchas apps de este estilo pero ninguna que nos permita cambiar tan libremente las rutinas adaptandolas a nuestras necesidades.    

As a waterpolo coach I had to analyze every match my teams play carfully, so i could find ways to improve the performance for the future games. Doing that by pen and paper it's really tedious, because it's an easy way to lose information for good, and moreover, every time the data changes, the calculations must be re-done.

So I though, maybe there's a way to make this easy, and that is how i came with the idea for this project.

---

## Deploy 🚀
<div align="center">
    <a href="https://master.d3axn9txrlwi1i.amplifyapp.com/"><strong>URL to Datapolo webpage </strong></a>🚀🚀🚀
</div>

---

## Stack

---

<div align="center">
<a href="https://www.php.net/">
    <img src= "https://img.shields.io/badge/php-7A86B8?style=for-the-badge&logo=php&logoColor=black"/>
</a>
<a href="https://laravel.com/">
    <img src= "https://img.shields.io/badge/laravel-F13C2F?style=for-the-badge&logo=laravel&logoColor=white"/>
</a>

 </div>

---

## E-R Diagram

---

!['imagen-db'](./assets/E-R%20diagram.jpg)

---

## Local instalation
---

1. Clone the repository.
2. ` $ composer install `
3. Connect your repository to your database.
4. Command to migrate the database: ``` $ php artisan migrate ``` 
5. Command to seed the database: ``` $ php artisan db:seed ``` 
6. Command to run the server: ``` $ php artisan serve ``` 

---

## Endpoints

---

<details>
<summary>Endpoints</summary>

- AUTH
    - REGISTER

            POST http://localhost:8000/api/newuser
        body:
        ``` js
            {
                "username": "Eddieden",
                "email": "eddieden@email.com",
                "password": "1234567W"
            }
        ```

    - LOGIN

            POST http://localhost:3000/api/login  
        body:
        ``` js
            {
                "email": "eddieden@email.com",
                "password": "1234567W"
            }
        ```
- STADISTICS
    - GET ALL MY GOAL STADISTICS  

            POST http://localhost:8000/api/my-goals-stadistics
            body:
        ``` js
            {
                "team_id": 51,
                "rival_id": 51,
                "season_id": 0,
                "locale": ""
            }
        ```

    - ...
</details>

---

## Future features

---

[ ] Defensive sstadistics  
[ ] Trophies won  
[ ] Search filters at players and teams  
[ ] ...

---

## Contributions

---

Advices and feedback are always welcome. 

These are some ways you may do it:

1. Open an issue
2. Fork the repository
    - Create a branch  
        ```
        $ git checkout -b feature/userName-newFeature
        ```
    - Commit your changes 
        ```
        $ git commit -m 'feat: newFeature is this'
        ```
    - Push to your branch
        ```
        $ git push origin feature/userName-newFeature
        ```
    - Open a Pull-request

---

## License

---

This project is under the MIT license for Ignacio Furió José

---

## Webgraphy:

---

I got some support information from:
- practice repositories 
- official documentation: https://laravel.com/docs/10.x

---

## Development:

---

``` js
 const developer = "Ignacio Furió José";

 console.log("Developed by: " + Ignacio Furió José);
```  

---

## Special thanks:

---

Thanks to everyone that supported me along this travel, it was intense, but also encouraging to start new and bigger projects.

Special thanks to my famlily, that includes some of my closest friends and classmates, your cheer words made it possible.

And also i  want to say thank you to the GeeksHubs Academy professors and the CDW Turia.

- **Dani**  
<a href="https://github.com/datata" target="_blank1"><img src="https://img.shields.io/badge/github-24292F?style=for-the-badge&logo=github&logoColor=blue" target="_blank1"></a> 

- **Jose**  
<a href="https://github.com/Dave86dev" target="_blank"><img src="https://img.shields.io/badge/github-24292F?style=for-the-badge&logo=github&logoColor=white" target="_blank"></a> 

- **David**  
<a href="https://www.github.com/Dave86dev/" target="_blank"><img src="https://img.shields.io/badge/github-24292F?style=for-the-badge&logo=github&logoColor=red" target="_blank"></a>

- ***Mara***  
<a href="https://www.github.com/MaraScampini/" target="_blank"><img src="https://img.shields.io/badge/github-24292F?style=for-the-badge&logo=github&logoColor=green" target="_blank"></a> 

---
## Contact
---
<a href = "mailto:bichoifj@gmail.com"><img src="https://img.shields.io/badge/Gmail-C6362C?style=for-the-badge&logo=gmail&logoColor=white" target="_blank"></a>
<a href="https://www.linkedin.com/in/ignacio-furi%C3%B3-0a9010233/" target="_blank"><img src="https://img.shields.io/badge/-LinkedIn-%230077B5?style=for-the-badge&logo=linkedin&logoColor=white" target="_blank"></a> 
</p>