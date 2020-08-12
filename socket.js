var app = require('express')();
var server = require('http').Server(app);
var io_server = require('socket.io')(server);
var io_client = require('socket.io-client')('http://localhost:3000');
var redis = require('redis');
var subscriber = redis.createClient();
var publisher  = redis.createClient();

server.listen(3000);

subscriber.subscribe("index");

subscriber.on("message", function(channel, data) {
    io_server.emit("new message", data);
    //message = JSON.parse(message);
    // users & user_name
});

io_server.on("connection", function(socket){

    console.log('user connected')

    socket.on('join', function (name) {

        console.log(name + " : has joined the chat " + socket.id);

    });

    socket.on('add', function (name, student_name) {
        console.log("add user " + student_name + " WeeklyForm");
        console.log(name + student_name);
    });
    
    socket.on("new message",function(message){

    });

    socket.on('typing', function(data){

    });

    socket.on('stop typing', function(data){

    });

    socket.on("disconnect",function(data){

    });
});


io_client.on("new message", function(data){
    console.log(data);
    io_client.emit('typing', "s");
});



/*redis.psubscribe('*', function(err, count){
    //does something, i hope...
    console.log('watching all channels...');
});*/

/*redis.on('pmessage', function(subscriber, channel, message){
    console.log("7trtrdtd");
    console.log(message);
    message = JSON.parse(message);
    io.emit(channel, message.data);
});*/

/*
const express = require('express'),
    http = require('http'),
    app = express(),
    server = http.createServer(app),
    io = require('socket.io').listen(server);
app.get('/', (req, res) => {

    res.send('Chat Server is running on port 3000')
});

io.on('connection', (socket) => {

    console.log('user connected')

    socket.on('join', function (name) {

        console.log(name + " : has joined the chat " + socket.id);

    });

    console.log('Client connected');

    socket.on("new message", function (message) {

    });

    socket.on('typing', function (data) {

    });

    socket.on('stop typing', function (data) {

    });

    socket.on("disconnect", function (data) {

    });




})






server.listen(3000, () => {

    console.log('Node app is running on port 3000')

})*/