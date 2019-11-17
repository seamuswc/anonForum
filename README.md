

###### Commands
    
    Uses PHP & MYSQL
    
    The following command cleans the DB and files in views/subs
        ./clean or 'php clean.php'

    To adjust DB connection username & password
        config.php 

    chmod views directory so channels can copy origin
    
    Local or Live
    core/Helpers.php there is a method called path_name()
    Set the $variable inside $live to true or false 
    Localmachine and apache file structures are different and this handles that.
    If local, will need to adjust the *name* in "/Users/*name*/desktop/anonForum/MVC/views/origin.php",  

    

    php -S localhost:8000 //local testing