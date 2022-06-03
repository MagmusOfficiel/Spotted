import React, {Fragment, useEffect} from 'react';

const Test = () => {
    return (
        <h2>
            Bonjour
        </h2>
    )
}

function Games(props) {
    useEffect(() => {
        console.log('Toto');
    }, []);

    return (
        <Fragment> 
            <h1 className="toto">Hello wolrd</h1>
            <Test />
        </Fragment>
    )
} 


export default Games;
