console.log("contact-form-local js running");

// jQuery(document).ready(function ($) {
// 	$("#contact-form-local-id").submit(function (event) {
// 		event.preventDefault(); // Prevent form submission
// 		console.log("running submit");
// 		var form = $(this);
// 		var url = form.data("url"); // Get the URL from the data attribute
// 		var nonce = form.data("nonce"); // Get the nonce from the data attribute

// 		console.log("URL:", url); // Ensure this logs the correct URL
// 		console.log("Nonce:", nonce); // Ensure this logs the correct nonce

// 		// Serialize the form data
// 		var formDataSerialized = form.serialize();
// 		console.log("Serialized data:", formDataSerialized);

// 		$.ajax({
// 			url: url, // Use the URL from the data attribute
// 			type: "POST",
// 			headers: { "X-WP-Nonce": nonce },
// 			data: formDataSerialized,
// 			// success: function (response) {
// 			// 	console.log("Email sent successfully:", response);
// 			// 	alert("Thank you for your message. We will get back to you soon!");
// 			// },
// 			// error: function (xhr, status, error) {
// 			// 	console.error("Failed to send email:", xhr.responseText);
// 			// 	alert("There was an error sending your message. Please try again later.");
// 			// },
// 		});
// 	});
// });

jQuery(document).ready(function ($) {
	$("#contact-form-local-id").submit(async function (event) {
		event.preventDefault(); // Prevent form submission
		var form = $(this);
		var url = form.data("url"); // Get the URL from the data attribute
		var nonce = form.data("nonce"); // Get the nonce from the data attribute

		console.log("URL:", url); // Ensure this logs the correct URL
		console.log("Nonce:", nonce); // Ensure this logs the correct nonce

		try {
			const response = await fetch(url, {
				method: "POST",
				headers: {
					"Content-Type": "application/x-www-form-urlencoded",
					"X-WP-Nonce": nonce,
				},
				body: form.serialize(),
			});

			if (!response.ok) {
				const responseText = await response.text();
				throw new Error("Failed to send email: " + responseText);
			}

			// const contentType = response.headers.get("content-type");
			// let responseData;

			// if (contentType && contentType.includes("application/json")) {
			// 	responseData = await response.json();
			// } else {
			// 	responseData = responseText;
			// }

			console.log("Email sent successfully:", responseData);
			// alert("Thank you for your message. We will get back to you soon!");
		} catch (error) {
			// console.error("Failed to send email:", error);
			// alert("There was an error sending your message. Please try again later. Error: " + error.message);
		}
	});
});
