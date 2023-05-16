import React from 'react';
import './ToDoList.css'
import Task from './Task'

function ToDoList(props){

    const taskElements = props.tasks.map((task) => (
        <Task 
            key={task.id} 
            task_id={task.id}
            taskName={task.name} 
            updateTask={props.updateTask} 
            taskCompleted={task.completed}
            hideDone={props.doneHidden}
        />
    ))

    return (
        <ul className={'ToDoList'}>
            {props.tasks.length>0?taskElements:"nothing to do..."}
        </ul>
    )
}

export default ToDoList