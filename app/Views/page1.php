<form method="GET">
    <label for="city">Filter by City:</label>
    <select name="city" id="city">
        <option value="">All</option>
        <? foreach ($city->getResult("array") as $city) : ?>
            <option value="<?= $city["Id"] ?>"><?= $city["City"] ?></option>
        <? endforeach; ?>
    </select><br>
    <label for="stars">Filter by Stars:</label>
    <select name="stars" id="stars">
        <option value="">All</option>
        <? foreach ($stars as $star) : ?>
            <option value="<?= $star['Stars'] ?>"><?= $star['Stars'] ?> Star(s)</option>
        <? endforeach; ?>
    </select><br>

    <button type="submit">Apply Filters</button>
</form>


<h1>Select by : City: <?= $selectedCity === "" ? "All" : $selectedCity ?> and Stars: <?= $selectedStars === "" ? "All" : $selectedStars ?></h1>


<h2>Hotels</h2>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Hotel Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stars</th>
            <th>City Id</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($hotel->getResult("array") as $hotel) : ?>
            <tr>
                <td><?= $hotel["Id"] ?></td>
                <td><?= $hotel["HotelName"] ?></td>
                <td><?= $hotel["Description"] ?></td>
                <td><?= $hotel["Price"] ?></td>
                <td><?= $hotel["Stars"] ?></td>
                <td><?= $hotel["CityId"] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>