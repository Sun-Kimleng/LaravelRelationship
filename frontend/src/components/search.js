import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";

const Search = () => {

    const navigate= useNavigate()

    const params = new URLSearchParams(window.location.search);

    const department = params.get('department')?params.get('department'):'';
    const country = params.get('country')?params.get('country'):'';
    const name = params.get('name')?params.get('name'):'';

    const [inputs, setInputs]=useState({
        name: null,
        department: null,
        country: null
    });
    
    const handleInput = (e)=>{
        setInputs({...inputs, [e.target.name]: e.target.value})
    }

    const handleSubmit= (e)=>{
        e.preventDefault();

        navigate(`/?name=${inputs.name}&department=${inputs.department}&country=${inputs.country}`);
    }

    return ( 

        <div className="search">
            <form className="form">
                
             Name: <input type="text" name="name" onChange={handleInput} value={inputs.name ===null?name:inputs.name}/><br />
             Department: <input type="text"name="department" onChange={handleInput} value={inputs.department ===null ?department:inputs.department}/><br />
             Coutry: <input type="text" name="country" onChange={handleInput} value={inputs.country === null ? country:inputs.country}/><br />

            <button type="submit">Search</button>
            <br />
            Name: {name} <br />
            Department: {department} <br />
            Country: {country}<br />
            </form>
        </div>
     );
}
 
export default Search;