<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Search Layout</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .search-container {
            margin: 20px 0;
            width: 100%;
            max-width: 800px;
            display: flex;
            gap: 10px;
        }

        .search-bar {
            flex: 2;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .dropdown-list {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .find-btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .find-btn:hover {
            background-color: #0056b3;
        }

        .results-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 100%;
            max-width: 1200px;
            max-height: 100vh;
            overflow-y: auto;
        }

        @media (min-width: 768px) {
            .results-container {
                flex-direction: row;
                overflow-y: hidden;
            }

            .results-list {
                flex: 1;
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 10px;
                overflow-y: auto;
                max-height: 70vh;
                max-width: 500px;
            }

            .result-details {
                flex: 2;
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 10px;
                overflow-y: auto;
                max-height: 70vh;
                max-width: 600px;
            }
        }

        .results-list table {
            width: 100%;
            border-collapse: collapse;
        }

        .results-list th, .results-list td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .table-filter {
            background-color: #fff;
            border-bottom: 1px solid #eee;
        }
        .table-filter tbody tr:hover {
            cursor: pointer;
            background-color: #eee;
        }
        .table-filter tbody tr td {
            padding: 10px;
            vertical-align: middle;
            border-top-color: #eee;
        }
        .table-filter tbody tr.selected td {
            background-color: #eee;
        }
        .table-filter tr td:first-child {
            width: 38px;
        }
        .table-filter tr td:nth-child(2) {
            width: 35px;
        }
        
        .table-filter .star {
            color: #ccc;
            text-align: center;
            display: block;
        }
        .table-filter .star.star-checked {
            color: #F0AD4E;
        }
        .table-filter .star:hover {
            color: #ccc;
        }
        .table-filter .star.star-checked:hover {
            color: #F0AD4E;
        }
        .table-filter .media-photo {
            width: 35px;
        }
        .table-filter .media-body {
            display: block;
            /* Had to use this style to force the div to expand (wasn't necessary with my bootstrap version 3.3.6) */
        }
        .table-filter .media-meta {
            font-size: 11px;
            color: #999;
        }
        .table-filter .media .title {
            color: #2BBCDE;
            font-size: 14px;
            font-weight: bold;
            line-height: normal;
            margin: 0;
        }
        .table-filter .media .title span {
            font-size: .8em;
            margin-right: 20px;
        }
        .table-filter .media .title span.pagado {
            color: #5cb85c;
        }
        .table-filter .media .title span.pendiente {
            color: #f0ad4e;
        }
        .table-filter .media .title span.cancelado {
            color: #d9534f;
        }
        .table-filter .media .summary {
            font-size: 14px;
        }

        .results-list td:hover {
            background-color: #f9f9f9;
        }

        .result-details {
            background-color: #fdfdfd;
        }
        .results-list tr.selected {
            background-color: #f0f8ff; /* Light blue */
            transition: background-color 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="search-container">
        <input type="text" class="search-bar" placeholder="Search...">
        <button class="find-btn">Find</button>
    </div>

    <div class="results-container">
        <div class="results-list">
            <table>
                <tbody>
                    <tr data-id="Details for Result 1">
                        <td>Result 1</td>
                    </tr>
                    <tr data-id="Details for Result 2">
                        <td>Result 2</td>
                    </tr>
                    <tr data-id="Details for Result 3">
                        <td>Result 3</td>
                    </tr>
                    <tr data-id="Details for Result 4">
                        <td>Result 4</td>
                    </tr>
                    <tr data-id="Details for Result 5">
                        <td>Result 5</td>
                    </tr>
                    <tr data-id="Details for Result 5">
                        <td>Result 5</td>
                    </tr>
                    <tr data-id="Details for Result 5">
                        <td>Result 5</td>
                    </tr>
                    <tr data-id="Details for Result 5">
                        <td>Result 5</td>
                    </tr>
                    <tr data-id="Details for Result 5">
                        <td>Result 5</td>
                    </tr>
                    <tr data-id="Details for Result 5">
                        <td>Result 5</td>
                    </tr>
                </tbody>

            </table>
        </div>

        <div class="result-details">
        <div class="container">
            <div class="mg-available-rooms">
                <h5 class="mg-sec-left-title">Date Posted: May 20, 2025</h5>
                <div class="mg-avl-rooms">
                    <div class="mg-avl-room">
                        <div class="row">
                            <div class="col-sm-2">
                                <!-- Optional Placeholder -->
                            </div>
                            <div class="col-sm-10">
                                <div style="border-bottom: 1px solid #ddd; padding: 10px; font-size: 25px; font-weight: bold; color: #000; margin-bottom: 5px;">
                                    Accounting
                                </div>
                                <div class="row contentbody">
                                    <div class="col-sm-6">
                                        <br>
                                        <p><strong>Job Details:</strong></p>
                                        <br>
                                        <ul style="text-indent: 30px;"><t>
                                            <li>Required No. of Employees: 3</li>
                                            <li>Salary: 200,000</li>
                                            <li>Duration of Employment: February 21</li>
                                            <li>Preferred Sex: Female</li>
                                            <li>Sector of Vacancy: Yes</li></t>
                                        </ul>
                                    </div><br>
                                    <div class="col-sm-12">
                                        <p><strong>Qualification/Work Experience:</strong></p><br>
                                        <ul>
                                            <li style="text-indent: 30px;">Two years of experience</li>
                                        </ul>
                                    </div><br>
                                    <div class="col-sm-12">
                                        <p><strong>Job Description:</strong></p><br>
                                        <ul>
                                            <li style="text-indent: 30px;"> We are looking for you</li>
                                        </ul>
                                    </div><br>
                                    <div class="col-sm-12">
                                        <p><strong>Employer:</strong> URC</p><br>
                                        <p><strong>Location:</strong> Sta Mesa</p>
                                    </div>
                                </div><br><br>
                                <form action="apply.html" method="post">
                                    <button type="submit" class="btn btn-main btn-next-tab" style=" display: grid; place-items: center; padding: 10px 20px; font-size: 16px;">Apply Now!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        </div>
    </div>
    
</body>
</html>
