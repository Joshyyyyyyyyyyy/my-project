const otp = document.querySelectorAll('.otp_field');

// Focus on first input
otp[0].focus();

otp.forEach((field, index) => {
    field.addEventListener('keydown', (e) => {
        if (e.key >= 0 && e.key <= 9) {
            field.value = ""; 
            setTimeout(() => {
                if (index + 1 < otp.length) {
                    otp[index + 1].focus();
                }
            }, 4);
        } else if (e.key === 'Backspace') {
            setTimeout(() => {
                if (index - 1 >= 0) {
                    otp[index - 1].focus();
                }
            }, 4);
        }
    });
});
