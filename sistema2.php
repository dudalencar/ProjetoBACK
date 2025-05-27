 body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #fff; /* Fundo azul escuro */
        color: #354982;
        padding: 40px;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #000; /* Branco para contraste */
    }

    form {
        text-align: center;
        margin-bottom: 20px;
    }

    input[type="text"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        width: 250px;
        background-color: #f9f9f9;
        color: #000;
    }

    input[type="text"]::placeholder {
        color: #888;
    }

    button {
        padding: 10px 20px;
        background-color: #2c3e66;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin-left: 10px;
        font-weight: bold;
    }

    button:hover {
        background-color: #223456;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #ffffff;
        color: #000;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    th, td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #354982; /* Cabeçalho da tabela azul escuro */
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    a {
        color: #000000;
        text-decoration: none;
        margin: 0 5px;
        transition: opacity 0.3s ease;
    }

    a:hover {
        opacity: 0.8;
        text-decoration: underline;
    }

    p strong {
        display: block;
        text-align: center;
        margin-bottom: 20px;
        color: #ffd700;
    }

    a[href="cadastro.php"] {
        display: block;
        text-align: center;
        margin-top: 30px;
        color: #000000;
        font-weight: bold;
        font-size: 16px;
    }

    a[href="cadastro.php"]:hover {
        text-decoration: underline;
    }

