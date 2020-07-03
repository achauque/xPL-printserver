[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PQVMD5AQAPM48&source=url)

<p align="center"><img src="https://raw.githubusercontent.com/achauque/xPL-printserver/master/public/imgs/logo.png" width="200"></p>

# xPL-printserver

This project is a print server for device with support xPL or compatible.\
Print direct via socket or use interface [xPL-printclient](https://github.com/achauque/xPL-client) to send via LPT, Serie or USB

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

# Format Template

```js
^XA
^FO70,10^GFA,5000,5000,25,gN0C,gN07CP01,gN03FM07JF,gN01FCJ01LF8,gO0FFI03MFC,gO07F801NFE,gO03FC0PF,gO03FF3PF8,gO01SFC,gP0SFE,gP07SF,gP07SF8,gP03SFC,gP01SFE,gQ0TF,:gQ07SF,:gQ03SF,gQ01SF,:gR0SF,gR0QFC,gR07NF,gR07LFC,gR03KF8,gR03JFC,gR01JF,:gR01JF8,gS0JF8,gS0JFC,gS07IFC,gS07IFE,:gS03JF,::gS03JF8,gS01JF8,gS01JFC,:gT0JFE,::gT0KF,:gT07JF8,::gT07JFC,::gT03JFE,:::gT03KF,::gT03KF8,:::gT03KFC,:::gT03KFE,::::gT03LF,::::gT03LF8,gH01FP03LF8,g01KF8M03LF8,Y01MFCL07LF8,Y0OFCK07LF8,X03PF8J07LF8,W01QFEJ07LF8,W07RF8I07LFC,W0TFI07LFC,V03TF800MFC,V07TFE00MFC,U01VF80MFC,U03VFC0MFC,U0XF0MFC,T01XFDMFC,T03gLFC,T0gMFC,S01gMFE,S03gMFE,S07gMFE,S0gNFE,R01gNFE,R03gNFE,R07gNFE,R0gOFE,Q01gOFE,Q03gOFE,Q07gOFE,Q0gPFE,P01gPFE,P03gPFE,P07gPFE,P0gQFE,O01gQFE,O03gQFE,O07gQFE,O0gRFE,N01gRFE,N03gRFE,:N07gRFE,N0gSFE,M01gSFE,:M03gSFC,M07gSFC,:M0gTFC,L01gTFC,:L03gTFC,:L07gTFC,:L0gUF8,:K01gUF8,::K03gUF8,:K03gUF,K07BgTF,:K077gTF,K077RFJ01WF,K0E7PFEM0UFE,K0E7PFN01TFE,K0CPFCO07SFE,K0COFEQ0SFE,K08OF8Q07RFE,K08OFR01RFC,K01NFES07QFC,K01NFCS03QFC,K01NFCT0QFC,K01NF8T07PF8,K01NF8T03PF8,K03NFV0PF8,:K03NFV07OF,K03MFEV07OF,:K03MFEV03NFE,K07MFCV03NFE,:K07MFCV03NFC,K07MFCV01NFC,:K07MFCV01NF8,::K07MFCV01NF,::K07MFCV01MFE,::K07MFCV03MFC,K07IFBIFCV03MFC,K07IF9IFCV03MF8,K07IF1IFCV03MF8,K07IF0IFEV07FFDJF8,K07IF07FFEV07FFDJF,K07FFE07FFEV0IF9JF,K07FFE03IFV0IF8IFE,K07FFE01IFU01IF0IFE,K07FFE01IFU01IF0IFC,K07FFE00IF8T03FFE0IFC,K07FFC007FF8T03FFC0IF8,K07FFC007FFCT07FFC07FF8,K07FFC003FFCT0IF807FF,K07FFC001FFES01IF007FF,K07FFC001IFS01IF007FE,K07FFCI0IFS03FFE007FE,K07FFCI07FF8R07FFC007FC,K03FFCI03FFCR0IF8007FC,K03FFCI03FFEQ01IFI07F8,K03FFCI01FFEQ03FFEI07F8,K03FFCJ0IFQ07FFCI07F,K03FFCJ07FF8P0IF8I07F,K03FFCJ03FFCO03IFJ07E,K01FFCJ03IFO07FFEJ07C,^FS

^CF0,30
^FO110,215^FD<##0>^FS

^BY2,2.5,50^FS
^FO40,240^BC^FD<##1>^FS
^XZ
```
The server replaces the <strong><##n></strong> tags with the parms content from the json message


# JSON Message

```js
{
    "template" : "test.xpl",
    "printer" : "0.0.0.0",
    "port" : 9100,
    "parms" : [
        "GUANACO",
        "12345678"
    ]
}
```
"template" : name of template file.
"printer" : ip address device. Use 0.0.0.0 to self send.
"port" : port number of device or xPL-printclient.
"parms" : all parameters for replace on template.