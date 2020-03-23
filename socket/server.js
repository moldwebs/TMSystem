var app = require('express')();
var http = require('http').createServer(app);
var io = require('socket.io')(http);
var amqp = require('amqplib/callback_api');

app.get('/', function(req, res){
    res.send('SOCKET');
});

io.on('connection', function(socket){
    console.log('a user connected');

    io.emit('message', 'connected ok');

    socket.on('logs', function(msg){
        console.log('logs: ' + msg);
    });
});

http.listen(3000, function(){
    console.log('listening on *:3000');
});

amqp.connect(process.env.AMQP_URL, function(error0, connection) {
    if (error0) {
        console.log(error0);
        throw error0;
    }
    connection.createChannel(function(error1, channel) {
        if (error1) {
            throw error1;
        }

        channel.consume('notifications', function(msg) {
            io.emit('notification', msg.content.toString());
        }, {
            noAck: true
        });
    });
});