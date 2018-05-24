let receiver = {
    list(callback) {
        $.ajax({
            method: "GET",
            url: server + "receiver/list",
        }).done(function (data) {
            if (data.status === 200) {
                let {result} = data;
                callback.call(this, result)
            } else {
                alert(404)
            }
        });
    },
    add(name, email, callback) {
        $.ajax({
            method: 'POST',
            url: server + "receiver/add",
            data: {
                name: name,
                email: email
            },
        }).done(function (data) {
            callback.call(this, data);
        });
    },
    delete(id, callback) {
        $.ajax({
            method: 'GET',
            url: server + "receiver/delete",
            data: {
                id: id
            },
        }).done(function (data) {
            callback.call(this, data);
        });
    }

};
receiver.add()