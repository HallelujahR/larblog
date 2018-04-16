
var http = require('http').Server();

var Redis = require('ioredis');

var redis = new Redis();

var io = require('socket.io')(http);
//监听频道
redis.subscribe('message');

redis.on('message',function(channel,data){
	var data1 = JSON.parse(data);
	console.log(data1);

	io.emit(channel+':'+data1.event,data1.data);

});


// var io = requrie('socket.io')(http);

http.listen('3001',function(){
	console.log('Server Star...');
});
