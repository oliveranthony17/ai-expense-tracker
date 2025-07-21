import {useState, useEffect} from 'react'
import ExpenseList from './components/ExpenseList';
import ExpenseForm from './components/ExpenseForm';

const API_KEY = import.meta.env.VITE_API_KEY;
const API_URL = import.meta.env.VITE_API_URL;

function App() {
    const [expenses, setExpenses] = useState([])

    useEffect(() => {
        loadExpenses();
    }, []);

    function loadExpenses() {
        fetch(API_URL, {
            headers: {
                'X-API-Key': API_KEY
            }
        })
            .then(res => res.json())
            .then(setExpenses)
            .catch(err => console.error(err));
    }

    function appendExpenseToTop(expense) {
        setExpenses(prev => [expense, ...prev]);
    }

    return (
        <div style={{ padding: '2rem' }}>
            <h1>Expenses</h1>
            <ExpenseForm onCreated={appendExpenseToTop}
                         apiKey={API_KEY}
                         apiUrl={API_URL} />
            <ExpenseList expenses={expenses} />
        </div>
    );
}

export default App
