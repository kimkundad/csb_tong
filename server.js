var socket  = require( './public/node_modules/socket.io' );
var express = require('./public/node_modules/express');
var app     = express();
var server  = require('http').createServer(app);
var io      = socket.listen( server );
var port    = process.env.PORT || 3000;

server.listen(port, function () {
  console.log('Server listening at port %d', port);
});


io.on('connection', function (socket) {

  socket.on( 'new_count_message', function( data ) {
    io.sockets.emit( 'new_count_message', {
    	new_count_message: data.new_count_message,
      all_count_message: data.all_count_message,
      count_user_all_new: data.count_user_all_new
    });
  });

/*  socket.on( 'update_count_message', function( data ) {
    io.sockets.emit( 'update_count_message', {
    	update_count_message: data.update_count_message
    });
  });
*/
  socket.on( 'new_message', function( data ) {
    io.sockets.emit( 'new_message', {
      code_id: data.code_id,
      name: data.name,
      part_day: data.part_day,
      job_title: data.job_title,
      current_branch: data.current_branch,
      area: data.area,
      income_time: data.income_time
    });
  });


});
