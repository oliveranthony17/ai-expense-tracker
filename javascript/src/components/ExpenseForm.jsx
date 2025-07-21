import { useState } from 'react';

const API_KEY = import.meta.env.VITE_API_KEY;
const API_URL = import.meta.env.VITE_API_URL;

export default function ExpenseForm({ onCreated }) {
    const [formData, setFormData] = useState({
        title: '',
        amount: '',
        date: '',
        category: '',
        description: ''
    });

    function handleChange(e) {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    }

    async function handleSubmit(e) {
        e.preventDefault();
        const response = await fetch(
            API_URL,
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-API-Key': API_KEY
                },
                body: JSON.stringify(formData)
            }
        );

        if (response.ok) {
            const data = await response.json();
            onCreated(data); // tell parent (App) to refresh
            setFormData({ title: '', amount: '', date: '', category: '', description: '' });
        } else {
            console.error('Failed to create expense');
        }
    }

    return (
        <form onSubmit={handleSubmit} className="expense-form">
            <h2>Create Expense</h2>

            <label>
                Title*
                <input name="title" value={formData.title} onChange={handleChange} required />
            </label>

            <label>
                Amount (CHF)*
                <input name="amount" type="number" step="0.01" value={formData.amount} onChange={handleChange} required />
            </label>

            <label>
                Date*
                <input name="date" type="date" value={formData.date} onChange={handleChange} required />
            </label>

            <label>
                Category
                <input name="category" value={formData.category} onChange={handleChange} />
            </label>

            <label>
                Description
                <input name="description" value={formData.description} onChange={handleChange} />
            </label>

            <button type="submit">Add Expense</button>
        </form>
    );
}
