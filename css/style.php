<style>
    .offcanvas-backdrop.show.fade {
        opacity: 0;
        position: static;
    }

    #add_activity.modal-backdrop.show {
        position: static;
        display: none;
    }

    .main-datatable {
        font-family: 'Raleway', sans-serif;
        padding: 0px;
        border: 1px solid #f3f2f2;
        border: 0;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, .05);
    }

    .card_body {
        background-color: white;
        border: 1px solid transparent;
        border-radius: 20px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        -webkit-border-radius: 20px;
        -moz-border-radius: 20px;
        -ms-border-radius: 20px;
        -o-border-radius: 20px;
    }

    .search_input input {
        border: 1px solid #e5e5e5;
        border-radius: 50px;
        transition: all .6s ease;
        width: 100%;
        margin-left: 8px;
        -webkit-transition: all .6s ease;
        -moz-transition: all .6s ease;
        -ms-transition: all .6s ease;
        -o-transition: all .6s ease;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        -ms-border-radius: 50px;
        -o-border-radius: 50px;
    }

    .select_input,
    .search_input label {
        color: #767676;
        font-weight: normal;
    }

    .search_input input:placeholder-shown {
        width: 25%;
    }

    .search_input:hover input:placeholder-shown {
        width: 100%;
        cursor: pointer;
    }

    .search_input::after {
        font-family: 'FontAwesome';
        color: #d4d4d4;
        position: relative;
        content: "\f002";
        right: 25px;
    }

    .main-datatable .dataTable.no-footer {
        border-bottom: 1px solid #eee;
    }

    .main-datatable .cust-datatable thead {
        background-color: #f9f9f9;
    }

    .main-datatable .cust-datatable>thead>tr>th {
        border-bottom-width: 0;
        color: #443f3f;
        font-weight: 600;
        padding: 16px 15px;
        vertical-align: middle;
        padding-left: 18px;
        text-align: center;
    }

    .main-datatable .cust-datatable>tbody td {
        padding: 10px 15px 10px 18px;
        color: #333232;
        font-size: 13px;
        font-weight: 500;
        word-break: break-word;
        border-color: #eee;
        text-align: center;
        vertical-align: middle;
    }

    .main-datatable .cust-datatable>tbody tr {
        border-top: none;
    }

    .main-datatable .table>tbody>tr:nth-child(even) {
        background: #f9f9f9;
    }

    .main-datatable .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #999;
        background-color: #f6f6f6;
        border-color: #d4d4d4;
        border-radius: 40px;
        margin: 5px 3px;
        -webkit-border-radius: 40px;
        -moz-border-radius: 40px;
        -ms-border-radius: 40px;
        -o-border-radius: 40px;
    }

    .main-datatable .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        color: #fff;
        border: 1px solid #3d96f5;
        background: #4da3ff;
        box-shadow: none;
    }

    .main-datatable .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .main-datatable .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        color: #fff;
        border-color: transparent;
        background: #007bff;
    }

    .main-datatable .dataTables_paginate {
        padding-top: 0;
        margin: 15px 10px;
        float: right;
    }

    @media only screen and (max-width:1400px) {
        .overflow-x {
            overflow-x: scroll;
        }

        .overflow-x::-webkit-scrollbar {
            width: 5px;
            height: 6px;
        }

        .overflow-x::-webkit-scrollbar-thumb {
            background-color: #888;
        }

        .overflow-x::-webkit-scrollbar-track {
            background-color: #f1f1f1;
        }
    }

    @media only screen and (max-width:575px) {
        .col_12 {
            max-width: 510px;
            min-width: 100px;
            width: 87vw;
        }
    }

    .title-signup {
        color: white;
        background-color: #FF8400;
        box-shadow: rgba(0, 0, 0, 1) 1.95px 1.95px 2.6px;
        position: absolute;
        top: -25px;
        left: 20px;
        border: none;
        cursor: pointer;
        padding: 10px 20px 10px 20px;
        border-radius: 15px;
        -webkit-border-radius: 15px;
        -moz-border-radius: 15px;
        -ms-border-radius: 15px;
        -o-border-radius: 15px;
    }

    .title-signup:hover {
        box-shadow: rgba(0, 0, 0, 1) -1.95px -1.95px 2.6px;
        background-color: #FF7000;
    }

    .title-signup:active {
        box-shadow: rgba(0, 0, 0, 1) -1.95px -1.95px 2.6px;
        transform: scale(0.95);
    }

    .inputBox {
        position: relative;
    }

    .inputBox input {
        width: 100%;
        padding: 10px;
        outline: none;
        border: none;
        color: #000;
        font-size: 1em;
        background: transparent;
        border-left: 2px solid #000;
        border-bottom: 2px solid #000;
        transition: 0.1s;
        border-bottom-left-radius: 8px;
    }

    .inputBox span {
        margin-top: 5px;
        position: absolute;
        left: 0;
        transform: translateY(-4px);
        margin-left: 10px;
        padding: 10px;
        pointer-events: none;
        font-size: 12px;
        color: #000;
        text-transform: uppercase;
        transition: 0.5s;
        letter-spacing: 3px;
        border-radius: 8px;
    }

    .inputBox input:valid~span,   
    .inputBox input:focus~span {
        transform: translateX(50px) translateY(-17px);
        font-size: 0.5em;
        padding: 5px 10px;
        background: #B2A4FF;
        letter-spacing: 0.2em;
        color: #fff;
        border: 2px;
    }

    .inputBox input:valid,
    .inputBox input:focus {
        border: 2px solid #000;
        border-radius: 8px;
    }

    .add-signup {
        font-weight: bold;
        color: white;
        background-color: #0A4D98;
        border-radius: 10px;
        width: 100px;
        border: none;
        margin-right: 40px;
        margin-bottom: 30px;
        padding: 10px 5px 10px 5px;
    }

    .add-signup:hover {
        transform: translate(-5px, -5px);
        box-shadow: #0A4D68 5px 7px 3px;
    }

    .add-signup:active {
        transform: translate(-3px, -3px);
        box-shadow: #0A4D68 3px 5px 3px;
    }

    .bg-loader {
        position: fixed;
        z-index: 99999999;
        background: #fff;
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
    }

    .loader {
        width: 48px;
        height: 48px;
        margin: auto;
        position: relative;
    }

    .loader:before {
        content: '';
        width: 48px;
        height: 5px;
        background: #f0808050;
        position: absolute;
        top: 60px;
        left: 0;
        border-radius: 50%;
        animation: shadow324 0.5s linear infinite;
    }

    .loader:after {
        content: '';
        width: 100%;
        height: 100%;
        background: #2857FF;
        position: absolute;
        top: 0;
        left: 0;
        border-radius: 4px;
        animation: jump7456 0.5s linear infinite;
    }

    @keyframes jump7456 {
        15% {
            border-bottom-right-radius: 3px;
        }
        25% {
            transform: translateY(9px) rotate(22.5deg);
        }
        50% {
            transform: translateY(18px) scale(1, .9) rotate(45deg);
            border-bottom-right-radius: 40px;
        }
        75% {
            transform: translateY(9px) rotate(67.5deg);
        }
        100% {
            transform: translateY(0) rotate(90deg);
        }
    }

    @keyframes shadow324 {
        0%,
        100% {
            transform: scale(1, 1);
        }
        50% {
            transform: scale(1.2, 1);
        }
    }
</style>