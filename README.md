# PHP API for Products

# About the Project

This Project is built using PHP using pure OOP concepts. It's an API to create, Read, and Delete products from Database. It uses Docker to set up server. You can follow the step shown in the `getting started`

## Built With

* PHP
* Docker

## Live Demo

[Live Demo Link](https://peppy-torte-82d0a1.netlify.app/)

## Getting Started

To get a local copy up and running, follow these simple example steps.

- [ ] On the project GitHub page, navigate to the main page of the repository.
- [ ] Under the repository name, locate and click on a green button named `Code`. 
- [ ] Copy the project URL as displayed.
- [ ] Navigate to the directory where you will like to install the repo by running `cd FOLDER-NAME`
- [ ] Type git clone, and then paste the URL you copied. <br>
e.g. `$ git clone https://github.com/Div685/scandiweb-frontend.git`
7. Press Enter. Your local copy will be created. 
8. Go to root folder where `docker-compose.yml` file is stored.
9. To run the server, run `docker-compose up`

To create and run database, follow these simple step. We are going to use docker to set up our PHPMYAdmin and server.
- [ ] check if your server is runnig, if not run `docker-compose up`.
- [ ] Type `http://localhost:8080` to open PHPMyAdmin on browser
- [ ] Use your UserName and Password to sign in.
- [ ] Create a Database Manually, use `test_db` as your database name and if you choose different name do not forget to change in `Database.php` file.
- [ ] Use the given SQL script (products.sql) on root folder to create your database table by importing it or creating manually.

## Author

👤 **Divyesh Patel**

- GitHub: [@Div685](https://github.com/Div685)
- Twitter: [@div_685](https://twitter.com/div_685)
- LinkedIn: [Divyesh Patel](https://www.linkedin.com/in/divyesh-daxa-patel/)


## Contributing

Contributions, issues, and feature requests are welcome!
Feel free to check the [issues page](../../issues).

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request


## Show your support

Give an ⭐️ if you like this project!


