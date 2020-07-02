[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PQVMD5AQAPM48&source=url)

<p align="center"><img src="https://raw.githubusercontent.com/achauque/xPL-printserver/master/public/imgs/logo.png" width="200"></p>

# xPL-printserver

This project is a print server for device with support xPL or compatible.\
Print direct via socket or use interface xPL-printclient to send via LPT, Serie or USB

# install

```console
user@guanaco:~$ git clone https://github.com/achauque/xPL-printserver.git

user@guanaco:~$ cd xPL-printserver
user@guanaco:~/xPL-printserver$ composer install
user@guanaco:~/xPL-printserver$ cp .env.example .env
user@guanaco:~/xPL-printserver$ php artisan key:generate
```


# Fast Test

```console

user@guanaco:~/xPL-printserver$ php artisan serv
Laravel development server started: http://127.0.0.1:8000

```

# JSON Message

```js
{
    "template" : "template.zpl",
    "printer" : "192.168.X.X",
    "port" : 9100,
    "parms" : [
        "1000.00 kg",
        "200.00 m",
        "250 mic"
    ]
}
```