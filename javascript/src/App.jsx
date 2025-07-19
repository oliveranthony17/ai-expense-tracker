import {useState, useEffect} from 'react'

const API_KEY = import.meta.env.VITE_API_KEY;
const API_URL = import.meta.env.VITE_API_URL;

function App() {
    const [expenses, setExpenses] = useState([])

    useEffect(
        () => {
            fetch(API_URL, {
                    headers: {
                        'X-API-Key': API_KEY
                    }
                }
            )
                .then(res => res.json())
                .then(setExpenses)
                .catch(err => console.error(err))
        },

        []
    )

    return (
        <div style={{padding: '2rem'}}>
            <h1>Expenses</h1>
            <ul>
                {expenses.map(expense => (
                    <li key={expense.id}>
                        <strong>{expense.title}</strong> – £{expense.amount} on {expense.date}
                        <br/>
                        <em>{expense.category}</em>
                        <p>{expense.description}</p>
                    </li>
                ))}
            </ul>
        </div>
    )
}

export default App
