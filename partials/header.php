<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>
    /* Global Styles */
    :root {
        --primary-color: #5C4033; /* Coffee Brown */
        --secondary-color: #A0522D; /* Lighter Brown */
        --background-color: #F7F3E8; /* Cream/Off-White */
        --text-color: #333;
        --border-color: #D3C4B8;
        --success-color: #4CAF50;
        --error-color: #D32F2F;
    }

    body { 
        font-family: 'Poppins', sans-serif; 
        margin: 0; 
        padding: 0;
        background-color: var(--background-color); 
        color: var(--text-color);
        line-height: 1.6;
    }

    .container { 
        max-width: 900px; 
        margin: 50px auto; 
        padding: 30px; 
        background: white; 
        border-radius: 12px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
        border: 1px solid var(--border-color);
    }

    h1, h2, h3 { 
        color: var(--primary-color); 
        border-bottom: 2px solid var(--border-color);
        padding-bottom: 10px;
        margin-top: 0;
    }

    /* Form & Input Styles */
    input, button, select { 
        width: 100%; 
        padding: 12px; 
        margin-bottom: 20px; 
        border-radius: 6px; 
        border: 1px solid var(--border-color); 
        box-sizing: border-box; 
        font-size: 16px;
        transition: border-color 0.3s;
    }
    input:focus {
        border-color: var(--secondary-color);
        outline: none;
    }

    button, .btn { 
        background-color: var(--primary-color); 
        color: white; 
        cursor: pointer; 
        font-weight: 600;
        text-transform: uppercase;
        border: none;
    }
    button:hover, .btn:hover {
        background-color: var(--secondary-color);
    }

    /* Message Styles */
    .message, .error-message { 
        padding: 15px; 
        border-radius: 6px; 
        margin-bottom: 20px;
        font-weight: 600;
        border: 1px solid;
    }
    .error-message { 
        color: var(--error-color); 
        background-color: #FFEEEE; 
        border-color: #FFC0C0;
    }
    .success-message {
        color: var(--success-color);
        background-color: #E8F5E9;
        border-color: #A5D6A7;
    }

    /* Table Styles */
    table { 
        width: 100%; 
        border-collapse: collapse; 
        margin-top: 25px; 
    }
    th, td { 
        border: 1px solid var(--border-color); 
        padding: 12px; 
        text-align: left; 
    }
    th { 
        background-color: var(--secondary-color); 
        color: white;
        font-weight: 700;
        text-transform: uppercase;
    }
    
    /* Links */
    a { 
        color: var(--secondary-color); 
        text-decoration: none; 
        font-weight: 600;
        transition: color 0.2s;
    }
    a:hover {
        color: var(--primary-color);
    }
    .action-links a {
        margin-right: 15px;
    }

</style>