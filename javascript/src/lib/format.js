const dateFormatter = new Intl.DateTimeFormat('de-CH', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
});

const currencyFormatter = new Intl.NumberFormat('de-CH', {
    style: 'currency',
    currency: 'CHF',
    minimumFractionDigits: 2
});

export function formatDate(date) {
    return dateFormatter.format(new Date(date));
}

export function formatMoney(amount) {
    return currencyFormatter.format(amount);
}
