function formatName(user) {
    return user.firstName + ' ' + user.lastName;
}

const user = {
    firstName: 'Harper',
    lastName: 'Perez'
};



const element = (
    <div>
        <h1>Hello, {formatName(user)}!</h1>
        <h2>Good to see you here.</h2>
    </div>
);

