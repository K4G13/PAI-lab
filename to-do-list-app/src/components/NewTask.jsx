import React from 'react';
import './NewTask.css'

function NewTask(props){
    return (
        <form className='NewTask'>
            <input type='text'/>
            <input type='button' value="Add" onClick={props.newTask}/>
        </form>
    )
}

export default NewTask