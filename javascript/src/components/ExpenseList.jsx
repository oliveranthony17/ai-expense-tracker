import ExpenseItem from './ExpenseItem';

export default function ExpenseList({ expenses }) {
    return (
        <ul className="expense-list">
            {expenses.map(expense => (
                <ExpenseItem key={expense.id} expense={expense} />
            ))}
        </ul>
    );
}
