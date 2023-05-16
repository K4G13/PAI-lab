import React from 'react';
import './App.css'
import Filter from './components/Filter'
import ToDoList from './components/ToDoList'
import NewTask from './components/NewTask'
import {nanoid} from "nanoid"

function App(){

    const [tasks,setTasks] = React.useState([])
    const [doneHidden,setDoneHidden] = React.useState(false)

    function createTask() {
        var str = document.querySelectorAll('.NewTask>input')[0].value
        if(!str) return
        document.querySelectorAll('.NewTask>input')[0].value = ""
        const newTask = {
            id: nanoid(),
            name: str,
            completed: false
        }
        setTasks(prevTasks => [...prevTasks,newTask])
    }

    function updateTask(e){
        var el_id = e.target.parentElement.getAttribute('id')
        // console.log(el_id)
        var target_id
        for(var i=0;i<tasks.length;i++){
            if(tasks[i].id==el_id){
                tasks[i].completed = !tasks[i].completed
                break
            }
        }
    }

    function hideDoneTasks(){
        setDoneHidden(!doneHidden)
    }

    return (
        <div className='App'>
            <h1>To Do list 🌴</h1>
            <Filter hideDoneTasks={hideDoneTasks}/> 
            <ToDoList tasks={tasks} updateTask={updateTask} doneHidden={doneHidden}/>
            <NewTask newTask={createTask}/>
        </div>
    )
}

export default App