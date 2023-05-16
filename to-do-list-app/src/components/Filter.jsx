import React from 'react'
import './Filter.css'

function Filter(props){
    return (
        <ul className='Filter'>
            <li>
                <input type='checkbox' onClick={props.hideDoneTasks}/> hide completed
            </li>
        </ul>
    )
}

export default Filter