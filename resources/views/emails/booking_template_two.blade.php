<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking Confirmation - {{ $company->company_name }}</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f6f6f6;">
  <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <!-- Header Section -->
    <div style="background-color: #0d0d0d; color: #ffffff; text-align: center; padding: 20px;">
      <img src="{{ $company->logo }}" alt="Logo" style="max-width: 200px;">
      <h1 style="margin: 0; font-size: 24px;">Your Booking is Confirmed!</h1>
    </div>

    <!-- Content Section -->
    <div style="padding: 20px; color: #333333;">
      <h2 style="font-size: 20px; margin-bottom: 10px; color: #b45ad4;">Hi {{ $booking->name }},</h2>
      <p style="font-size: 16px; line-height: 1.5; margin: 0 0 15px;">Thank you for choosing <strong>{{ $company->company_name }}</strong>! Your booking has been successfully created. Below are your reservation details:</p>

      <!-- Booking Details Cards -->
      <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px;">
        <!-- Card 1: Personal Details -->
        <div style="flex: 1; min-width: 250px; background-color: #f9f9f9; padding: 15px; border-radius: 8px;">
          <h3 style="font-size: 18px; margin-bottom: 10px; color: #b45ad4;">Personal Details</h3>
          <p><strong>Name:</strong> {{ $booking->name }}</p>
          <p><strong>Email:</strong> {{ $booking->email }}</p>
          <p><strong>Phone Number:</strong> {{ $booking->phone }}</p>
        </div>

        <!-- Card 2: Booking Details -->
        <div style="flex: 1; min-width: 250px; background-color: #f9f9f9; padding: 15px; border-radius: 8px;">
          <h3 style="font-size: 18px; margin-bottom: 10px; color: #b45ad4;">Booking Details</h3>
          <p><strong>Booking Date:</strong> {{ $booking->booking_date }}</p>
          <p><strong>Booking Time:</strong> {{ $booking->booking_time }}</p>
          <p><strong>Pick-Up Date:</strong> {{ $booking->pickup_date }}</p>
          <p><strong>Pick-Up Time:</strong> {{ $booking->pickup_time }}</p>
        </div>

        <!-- Card 3: Trip Details -->
        <div style="flex: 1; min-width: 250px; background-color: #f9f9f9; padding: 15px; border-radius: 8px;">
          <h3 style="font-size: 18px; margin-bottom: 10px; color: #b45ad4;">Trip Details</h3>
          <p><strong>Pick-Up Location:</strong> {{ $booking->pickup_location }}</p>
          <p><strong>Drop-Off Location:</strong> {{ $booking->dropoff_location }}</p>
          <p><strong>Number of Passengers:</strong> {{ $booking->number_of_passengers }}</p>
          <p><strong>Vehicle Type:</strong> {{ $booking->vehicle_type }}</p>
        </div>
      </div>

      <!-- Additional Information -->
     
   
      <div style="background-color: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        <h3 style="font-size: 18px; margin-bottom: 10px; color: #b45ad4;">Reservation Details</h3>
    <p style="font-size: 18px; line-height: 1.5; margin: 0 0 15px; text-align: justify; background-color: #f6f6f6; padding: 10px; border: 1px solid #00000059; border-radius: 8px; color: #000; ">Our booking agent will reach out to you within 30 minutes of your scheduled pick-up time. If you have any changes or special requests, please feel free to reply to this email.</p>
  </div>

  <p style="font-size: 14px;  line-height: 1.5; margin: 0 0 15px; background-color: #f8f8f8; text-align: center; font-weight: bold; padding: 10px; border-radius: 8px; color: #b45ad4;">Our booking agent will reach out to you within 30 minutes of your scheduled pick-up time. If you have any changes or special requests, please feel free to reply to this email.</p>



    <!-- Footer Section -->
    <div style="text-align: center; padding: 15px; background-color: #0d0d0dec; font-size: 16px; color: #fff;">
      <p>We look forward to serving you!</p>
      <p><strong>{{ $company->company_name }}</strong></p>
      <p style="margin: 5px 0;">Email: <a href="mailto:{{ $company->email }}" style="color: #b45ad4; text-decoration: none;">{{ $company->email }}</a> | Phone: <a href="tel:{{ $company->phone }}" style="color: #b45ad4; text-decoration: none;">{{ $company->phone }}</a></p>
      
      <!-- Social Media Links -->
      <div style="margin-top: 10px;">
        <a href="{{ $company->facebook_url }}" style="margin: 0 10px;"><img src="https://ucarecdn.com/8dfd998e-832f-49de-995a-262088d407f9/facebook.png" alt="Facebook" style="width: 20px;"></a>
        <a href="{{ $company->instagram_url }}" style="margin: 0 10px;"><img src="https://ucarecdn.com/af394f85-12ae-4771-99bf-705fded2ff28/instagram.png" alt="Instagram" style="width: 20px;"></a>
        <!-- <a href="https://twitter.com/squarelimo" style="margin: 0 10px;"><img src="/images/icon/twitter.png" alt="Twitter" style="width: 20px;"></a> -->
        <a href="{{ $company->linkedin_url }}" style="margin: 0 10px;"><img src="https://ucarecdn.com/82457564-c194-4f36-993c-23bc72f16794/linkedin.png" alt="LinkedIn" style="width: 20px;"></a>
      </div>

      <!-- App Download Links -->
      <div style="margin-top: 20px; margin-bottom: 20px;">
        <p style="font-size: 16px; font-weight: bold;">Download Our App</p>
        <a href="{{ $company->playstore_url }}" style="margin: 0 10px;"><img src="https://ucarecdn.com/7fac38d8-e33e-4bd3-8cc8-ba1d1a338813/play.webp" alt="Google Play" style="width: 120px;"></a>
        <a href="{{ $company->appstore_url }}" style="margin: 0 10px;"><img src="https://ucarecdn.com/23b1b97e-0ec1-42e6-a49a-e9dfe03ed520/app.png" alt="App Store" style="width: 120px;"></a>
      </div>
    </div>
  </div>
</body>
</html>