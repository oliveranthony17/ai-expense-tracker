import { formatDate, formatMoney } from '../lib/format';

export default function ExpenseItem({ expense }) {
    return (
        <li className="expense-item">
            <strong>{expense.title}</strong> – {formatMoney(expense.amount)} on {formatDate(expense.date)}
            <br />
            <em>{expense.category}</em>
            <p>{expense.description}</p>
        </li>
    );
}
