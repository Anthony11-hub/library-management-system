const express = require('express');
const expressSession = require("express-session");
const bodyParser = require('body-parser');
const cookieParser = require('cookie-parser');
const path = require('path');

const app = express();


// const port = 3000;

// controllers
const signup = require('./controllers/signup');
const login = require('./controllers/login');
const logout = require('./controllers/logout');

// admin controllers
const admin = require('./controllers/admin');

// student controllers
const student = require('./controllers/student');


const PORT = process.env.PORT || 8080

app.set('view engine', 'ejs');

const OneDay = 1000 * 60 * 60 * 24;

// parse the incoming data
app.use(express.json());
app.use(bodyParser.urlencoded({ extended: false }));

// cookie parser middelware
app.use(cookieParser());

app.use(expressSession({
    secret: 'SuperSecret',
    resave: false,
    saveUninitialized: true,
    cookie: { maxAge: OneDay }

    
}));

// load assets
app.use('/css', express.static(path.join(__dirname, '/assets/css')));
app.use('/img', express.static(path.join(__dirname, '/assets/css')));
app.use('/js', express.static(path.join(__dirname, '/assets/js')));

// app.use('/css', express.static(__dirname + '/css'));


app.use('*', function(req, res, next) {
    if(req.originalUrl == '/login' || req.originalUrl == '/signup') {
        next();
    }
    else {
        if(!req.session.admin || !req.session.student) {
            res.redirect('/login');
            return;
        }
        next();
    }
});

// routes
app.use('/login', login);
app.use('/signup', signup);
app.use('/logout', logout);



// admin routes
app.use('/admin', admin);

// student route
app.use('/student', student);


// database
// const mysql = require('mysql');

// const connection = mysql.createConnection({
//     host: 'localhost',
//     user: 'root',
//     password: '',
//     database: 'library_management_system'
// });


// connection.connect((err) => {
//     if(err){
//         throw err;
//     }
//     console.log('mysql connection established');
// });


app.listen(PORT, () => {
    console.log(`server started on port ${PORT}`);
})