//closures

//defining function that keeps track of accountbalance making it "private"

const manageBankAccount = function (initialBalance) {
//initialBalance is actually created here, will be accessible only by inner functions
    let accountBalance = initialBalance;

    return {
        getBalance: function () { return accountBalance; },
        deposit: function (amount) { accountBalance += amount; },
        withdraw: function (amount) {
            if (amount > accountBalance) {
                return 'You cannot draw that much!';
            }

            accountBalance -= amount;
        }
    };
}

//using closure function: one call for the returned function, and one more for the inner functions.

//1) instantiate variable with returned functions: 

var accountManager = manageBankAccount(8900)

// 2) after this inner functions will be available as "methods"

accountManager.getBalance()

accountManager.withdraw(500)

accountManager.deposit(500)


