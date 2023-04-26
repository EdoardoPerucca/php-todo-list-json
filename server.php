<?php 

// verifico di ricevere la chimata POST
if(isset($_POST['newTodo'])) {

  // salvo il nuovo todo nel file json
  $newTodo = array();
  $newTodo['text'] = $_POST['newTodo'];
  $newTodo['done'] = false;

  // prendo il json
  $todosJSON = file_get_contents('todos.json');
  
  // lo modifico in array php
  $todos = json_decode($todosJSON);
  
  // push
  $todos[] = $newTodo;

  // converto in json
  $newTodoJSON = json_encode($todos);

  // lo salvo nel file
  file_put_contents('todos.json', $newTodoJSON);

  
} else if(isset($_POST['toggleTodoIndex'])) {
  
  // prendo la stringa json dei todo
  $todosJSON = file_get_contents('todos.json');

  // lo modifico in array php
  $todos = json_decode($todosJSON);

  // cambio la proprietà done dell'elemento corretto con il suo opposto
  $todos[$_POST['toggleTodoIndex']]->done = !$todos[$_POST['toggleTodoIndex']]->done;

  // converto l'array di oggetti php in json
  $todosJSON = json_encode($todos);

  // salvo i nuovi todo
  file_put_contents('todos.json', $todosJSON);


} else if(isset($_POST['deleteTodoIndex'])) {


  // prendo la stringa json dei todo
  $todosJSON = file_get_contents('todos.json');
  
  // lo modifico in array php
  $todos = json_decode($todosJSON);

  // elimino l'elemento che corrisponde all'indice inviatomi tramite la chiamata api
  array_splice($todos, $_POST['deleteTodoIndex'], 1);

  // converto l'array di OGGETTI php in json
  $todosJSON = json_encode($todos);

  // salvo i nuovi todo
  file_put_contents('todos.json', $todosJSON);


} else {

  // prendo l'array dal file json
  $todoFile = file_get_contents('todos.json');

  // trasformo in un array php
  $todos = json_decode($todoFile);
  
  // dico al browser che è un JSON
  header('Content-type: application/json');

  // stampo array php in JSON
  echo json_encode($todos);

}