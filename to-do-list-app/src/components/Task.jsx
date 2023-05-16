import React from 'react';

function Task(props){
    return (
        <li id={props.task_id} hidden={props.hideDone&&props.taskCompleted}>
            <input type='checkbox'
            onChange={props.updateTask} 
            defaultChecked={props.taskCompleted?true:false}/> 
            {props.taskName}
        </li>
    )

}

export default Task