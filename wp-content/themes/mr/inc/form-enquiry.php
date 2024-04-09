<form id="enquiry-form">
    <label for="first-name">First Name</label>
    <input type="text" id="first-name" name="first-name" required><br>
    <label for="last-name">Last Name</label>
    <input type="text" id="last-name" name="last-name" required><br>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required><br>
    <label for="message">Message</label>
    <textarea id="message" name="message" cols="30" rows="10" required></textarea><br>
    <button type="submit">Submit</button>
</form>



<script>
document.getElementById('enquiry-form').addEventListener('submit', function(e) {
    e.preventDefault();
    let form = this;
    let formData = {
        firstName: form['first-name'].value,
        lastName: form['last-name'].value,
        email: form['email'].value,
        message: form['message'].value
    };

    console.log(formData);
    //make the AJAX POST request to submit form data wordpress
    let  endpointUrl = '<?php echo admin_url('admin-ajax.php'); ?>';

    fetch(endpointUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: Object.keys(formData).map(key => encodeURIComponent(key) + '=' + encodeURIComponent(formData[key])).join('&')
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.success) {
            form.reset();
            alert('Enquiry successfully sent!');
        } else {
            alert('Oops, something went wrong.');
        }
    })
    .catch(error => console.log(error));




});
</script>


