
## A barebones PHP program that plays a movie after receiving a BTC payment.
*Note: BTC payments sent from exchanges can take 10 minutes to verify, most wallets take 5 seconds.*

After download you'll be directed to a register page and asked for:
Username, Password, and your Gemini Keys

Simple login and backend for MP4 uploads.

Simple BTC payment system that redirects the user to the movie after a BTC payment.


## Need a Gemini account for dynamic BTC address creation.

  Create API Keys. Select Fund Management as API key type. This allows
  address creation but not sending or selling of funds.


## Server Setup: Recommend DigitalOcean & Ubuntu

###### Step 1 (optional) - https://www.digitalocean.com/community/tutorials/initial-server-setup-with-ubuntu-16-04

###### Step 2 (Mandatory) - https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04

also run *apt-get install composer* in step 2

###### Step 3 (Mandatory) - https://www.digitalocean.com/community/tutorials/how-to-rewrite-urls-with-mod_rewrite-for-apache-on-ubuntu-16-04

**Ok, now time to pull in the site. First we need to clean out the web directory. Only need to do this if there are files in the HTML folder**

    cd /var/www/html

    rm *

    rm .htaccess


**Pull in the git**

    git clone https://github.com/seamuswc/BTCstreaming.git .

**load the dependencies and map out the files**

    composer install

    composer dump-autoload


# Potentials Database related crashes 

###### 'config.php' contains the database connection information. Edit it to adjsut 'username', 'password', etc...

###### The program automatically creates a database called 'stream'. If there is already a Database with this name the program might not work.

# Good to Go!

###### Add SSL: https://www.digitalocean.com/community/tutorials/how-to-secure-apache-with-let-s-encrypt-on-ubuntu-16-04

## License

This project is licensed under the MIT License
