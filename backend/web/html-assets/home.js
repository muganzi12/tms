//define some sample data
var sampleData = [{
        id: 1,
        name: "Oli Bob",
        progress: 12,
        gender: "male",
        rating: 1,
        col: "red",
        dob: "",
        car: 1,
        lucky_no: 5,
        cheese: "Cheader"
    },
    {
        id: 2,
        name: "Mary May",
        progress: 1,
        gender: "female",
        rating: 2,
        col: "blue",
        dob: "14/05/1982",
        car: true,
        lucky_no: 10,
        cheese: "Gouda"
    },
    {
        id: 3,
        name: "Christine Lobowski",
        progress: 42,
        gender: "female",
        rating: 0,
        col: "green",
        dob: "22/05/1982",
        car: "true",
        lucky_no: 12,
        cheese: "Manchego"
    },
    {
        id: 4,
        name: "Brendon Philips",
        progress: 100,
        gender: "male",
        rating: 1,
        col: "orange",
        dob: "01/08/1980",
        lucky_no: 18,
        cheese: "Brie"
    },
    {
        id: 5,
        name: "Margret Marmajuke",
        progress: 16,
        gender: "female",
        rating: 5,
        col: "yellow",
        dob: "31/01/1999",
        lucky_no: 33,
        cheese: "Cheader"
    },
];

$("#example-table").tabulator({
    columns: [{
            title: "Name",
            field: "name",
            sortable: true,
            width: 200
        },
        {
            title: "Progress",
            field: "progress",
            sortable: true,
            sorter: "number"
        },
        {
            title: "Gender",
            field: "gender",
            sortable: true
        },
        {
            title: "Favourite Color",
            field: "col",
            sortable: false
        },
        {
            title: "Date Of Birth",
            field: "dob"
        },
        {
            title: "Cheese Preference",
            field: "cheese"
        },
    ],
});

//load sample data into the table
$("#example-table").tabulator("setData", sampleData);