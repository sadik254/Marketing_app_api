<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking Confirmation - {{ $company->company_name }}</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f6f6f6;">
  <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <div style="background-color: #0d0d0d; color: #ffffff; text-align: center; padding: 20px;">
      <img src="{{ $company->logo }}" alt="Logo" style="max-width: 200px;">
      <h1 style="margin: 0; font-size: 24px;">Your Booking is Confirmed!</h1>
    </div>
    <div style="padding: 20px; color: #333333;">
      <h2 style="font-size: 20px; margin-bottom: 10px; color: #b45ad4;">Hi {{ $booking->name }},</h2>
      <p style="font-size: 16px; line-height: 1.5; margin: 0 0 15px;">Thank you for choosing <strong>{{ $company->company_name }}</strong>! Your booking has been successfully created. Below are your reservation details:</p>
      
      <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
          <th style="padding: 10px; text-align: left; border: 1px solid #ddd; background-color: #f3f3f3;">Name</th>
          <td style="padding: 10px;  border: 1px solid #ddd;">{{ $booking->name }}</td>
        </tr>
        <tr>
          <th style="padding: 10px; text-align: left; border: 1px solid #ddd; background-color: #f3f3f3;">Email</th>
          <td style="padding: 10px; border: 1px solid #ddd;">{{ $booking->email }}</td>
        </tr>
        <tr>
          <th style="padding: 10px; text-align: left; border: 1px solid #ddd; background-color: #f3f3f3;">Phone Number</th>
          <td style="padding: 10px; border: 1px solid #ddd;">{{ $booking->phone }}</td>
        </tr>
        <tr>
          <th style="padding: 10px; text-align: left; border: 1px solid #ddd; background-color: #f3f3f3;">Booking Date</th>
          <td style="padding: 10px; border: 1px solid #ddd;">{{ $booking->booking_date }}</td>
        </tr>
        <tr>
          <th style="padding: 10px; text-align: left; border: 1px solid #ddd; background-color: #f3f3f3;">Booking Time</th>
          <td style="padding: 10px; border: 1px solid #ddd;">{{ $booking->booking_time }}</td>
        </tr>
        <tr>
          <th style="padding: 10px; text-align: left; border: 1px solid #ddd; background-color: #f3f3f3;">Pick-Up Date</th>
          <td style="padding: 10px; border: 1px solid #ddd;">{{ $booking->pickup_date }}</td>
        </tr>
        <tr>
          <th style="padding: 10px; text-align: left; border: 1px solid #ddd; background-color: #f3f3f3;">Pick-Up Time</th>
          <td style="padding: 10px; border: 1px solid #ddd;">{{ $booking->pickup_time }}</td>
        </tr>
        <tr>
          <th style="padding: 10px; text-align: left; border: 1px solid #ddd; background-color: #f3f3f3;">Pick-Up Location</th>
          <td style="padding: 10px; border: 1px solid #ddd;">{{ $booking->pickup_location }}</td>
        </tr>
        <tr>
          <th style="padding: 10px; text-align: left; border: 1px solid #ddd; background-color: #f3f3f3;">Drop-Off Location</th>
          <td style="padding: 10px; border: 1px solid #ddd;">{{ $booking->dropoff_location }}</td>
        </tr>
        {{-- <tr>
          <th style="padding: 10px; text-align: left; border: 1px solid #ddd; background-color: #f3f3f3;">Date & Time</th>
          <td style="padding: 10px; border: 1px solid #ddd;">[Date & Time]</td>
        </tr> --}}
        <tr>
          <th style="padding: 10px; text-align: left; border: 1px solid #ddd; background-color: #f3f3f3;">Number of Passengers</th>
          <td style="padding: 10px; border: 1px solid #ddd;">{{ $booking->number_of_passengers }}</td>
        </tr>
        <tr>
          <th style="padding: 10px; text-align: left; border: 1px solid #ddd; background-color: #f3f3f3;">Vehicle Type</th>
          <td style="padding: 10px; border: 1px solid #ddd;">{{ $booking->vehicle_type }}</td>
        </tr>
      </table>
    <div>
        <h2 style="font-size: 20px; text-align: center; margin-bottom: 10px; color: #000;">Reservation Details</h2>
      <p style="font-size: 18px; line-height: 1.5; margin: 0 0 15px; text-align: justify; background-color: #f6f6f6; padding: 10px; border: 1px solid #00000059; border-radius: 8px; color: #000; ">Our booking agent will reach out to you within 30 minutes of your scheduled pick-up time. If you have any changes or special requests, please feel free to reply to this email.</p>
    </div>
      <p style="font-size: 14px;  line-height: 1.5; margin: 0 0 15px; background-color: #f8f8f8; text-align: center; font-weight: bold; padding: 10px; border-radius: 8px; color: #b45ad4;">Our booking agent will reach out to you within 30 minutes of your scheduled pick-up time. If you have any changes or special requests, please feel free to reply to this email.</p>
    </div>
    <div style="text-align: center; padding: 15px; background-color: #0d0d0d; font-size: 16px; color: #fff;">
      <p>We look forward to serving you!</p>
      <p><strong>{{ $company->company_name }}</strong></p>
      <p style="margin: 5px 0;">Email: <a href="mailto:{{ $company->email }}" style="color: #b45ad4; text-decoration: none;">{{ $company->email }}</a> | Phone: <a href="tel:{{ $company->phone }}" style="color: #b45ad4; text-decoration: none;">{{ $company->phone }}</a></p>
      
      <div style="margin-top: 10px;">
        <a href="{{ $company->facebook_url }}" style="margin: 0 10px;"><img src="https://ucarecdn.com/8dfd998e-832f-49de-995a-262088d407f9/facebook.png" alt="Facebook" style="width: 20px;"></a>
        <a href="{{ $company->instagram_url }}" style="margin: 0 10px;"><img src="https://ucarecdn.com/af394f85-12ae-4771-99bf-705fded2ff28/instagram.png" alt="Instagram" style="width: 20px;"></a>
        <a href="{{ $company->linkedin_url }}" style="margin: 0 10px;"><img src="https://ucarecdn.com/82457564-c194-4f36-993c-23bc72f16794/linkedin.png" alt="LinkedIn" style="width: 20px;"></a>
      </div>
      <div style="margin-top: 20px; margin-bottom: 20px;">
        <p style="font-size: 16px; font-weight: bold;">Download Our App</p>
        <a href="{{ $company->playstore_url }}" style="margin: 0 10px;"><img src="https://ucarecdn.com/7fac38d8-e33e-4bd3-8cc8-ba1d1a338813/play.webp" alt="Google Play" style="width: 120px;"></a>
        <a href="{{ $company->appstore_url }}" style="margin: 0 10px;"><img src="https://ucarecdn.com/23b1b97e-0ec1-42e6-a49a-e9dfe03ed520/app.png" alt="App Store" style="width: 120px;"></a>
      </div>
    </div>
  </div>
</body>
</html>
