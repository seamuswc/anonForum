
## A barebones PHP program that plays a movie after receiving a BTC payment.
*Note: BTC payments sent from exchanges can take 10 minutes to verify, most wallets take 5 seconds.*

**Trailer stored in: public/trailers/trailer.MP4**

**Movie stored in: public/movies/movie.MP4**

*Video must be a MP4*


##Need a Gemini account for dynamic BTC address creation.

  Create API Keys. Select Fund Management as API key type. This allows
  address creation but not sending or selling of funds.

  Add the keys at top in the pub_key and priv_key variables.
 **MVC/controllers/pagesController**


## Server Setup: Recommend DigitalOcean & Ubuntu

###### Step 1 (optional) - https://www.digitalocean.com/community/tutorials/initial-server-setup-with-ubuntu-16-04

###### Step 2 (Mandatory) - https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04

**also run *apt-get install composer* in step 2**

###### Step 3 (Mandatory) - https://www.digitalocean.com/community/tutorials/how-to-rewrite-urls-with-mod_rewrite-for-apache-on-ubuntu-16-04

**Ok now time to pull in the site. First need to clean out the web directory.**

    cd /var/www/html

    rm *

    rm .htaccess


**Pull in the git**

    git clone https://github.com/itadakiru/BTCstreaming.git .

**load the dependencies and map out the files**

    composer install

    composer dump-autoload

**This allows the php router to work**

    nano .htaccess

    RewriteEngine on

    RewriteRule ^paid$ index.php [NC]

    RewriteRule ^checkPayment$ index.php [NC]


# Good to Go!


###### Add SSL: https://www.digitalocean.com/community/tutorials/how-to-secure-apache-with-let-s-encrypt-on-ubuntu-16-04
