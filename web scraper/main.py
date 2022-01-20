from bs4 import BeautifulSoup
import requests
import shutil
import csv
import logging


logging.basicConfig(filename='info.log',
                    format='%(asctime)s - %(message)s', level=logging.INFO)

# global vars
primary_key = 1
car_specs_global = []
switch_case = {
    "Cylinders": 5,
    "Displacement": 6,
    "Power": 7,
    "Torque": 8,
    "Fuel System": 9,
    "Fuel": 10,
    "Fuel capacity": 11,
    "Top Speed": 12,
    "Acceleration 0-62 Mph (0-100 kph)": 13,
    "Drive Type": 14,
    "Gearbox": 15,
    "Front": 16,
    "Rear": 17,
    "Tire Size": 18,
    "Length": 19,
    "Width": 20,
    "Height": 21,
    "Front/rear Track": 22,
    "Wheelbase": 23,
    "Ground Clearance": 24,
    "Cargo Volume": 25,
    "Aerodynamics (Cd)": 26,
    "Unladen Weight": 27,
    "City": 28,
    "Highway": 29,
    "Combined": 30,
    "CO2 Emissions": 31,
    "Power pack": 32,
    "Maximum Capacity": 33,
    "Range": 34,
}


try:

    main_page = requests.get('https://www.autoevolution.com/cars/').text
    soup = BeautifulSoup(main_page, 'lxml')
    manufacturer_links = soup.find_all(
        'div', class_='col2width fl bcol-white carman')

    for manufacturer_link in manufacturer_links:
        man_link = manufacturer_link.a['href']  # link to the manufacturer page
        manufacturer_page = requests.get(man_link).text
        soup_manufacturers = BeautifulSoup(manufacturer_page, 'lxml')
        model_links = soup_manufacturers.find_all('div', class_='carmod')
        manufacturer_name = soup_manufacturers.find('h1').a.b.text

        for model_link in model_links:
            mod_link = model_link.a['href']  # link to the model page
            model_page = requests.get(mod_link).text
            soup_model = BeautifulSoup(model_page, 'lxml')

            model_section = soup_model.find_all(
                'div', class_='container carmodel clearfix')
            for sec in model_section:
                mod_pic = sec.find('a', class_='mpic fr')
                img_link = mod_pic.img['src']
                img_title = 'images/' + img_link.split('/')[-1]
                r = requests.get(img_link, stream=True)
                if r.status_code == 200:
                    with open(img_title, 'wb') as f:
                        r.raw.decode_content = True
                        shutil.copyfileobj(r.raw, f)

                years = sec.find('p', class_='years').text
                model_name = sec.h2.span.text

                engine_modifications = sec.find_all('p', class_='engitm')
                for engine_modification in engine_modifications:
                    car_specs = ['']*36
                    car_specs[0] = primary_key  # setting id
                    primary_key += 1
                    # setting manufacturer's name
                    car_specs[1] = manufacturer_name
                    car_specs[2] = model_name  # setting model name
                    car_specs[35] = img_title  # setting image path
                    car_specs[4] = years  # setting production years
                    engmod_link = engine_modification.a['href']
                    engmod_page = requests.get(engmod_link).text
                    soup_engmod = BeautifulSoup(engmod_page, 'lxml')
                    # setting title
                    car_specs[3] = engine_modification.span.text

                    # algorithm that takes the specs from the website and puts them in a list, which is then appended to a global list and then added to the csv file
                    dts = soup_engmod.find_all('dt')
                    dds = soup_engmod.find_all('dd')
                    for index, dt in enumerate(dts):
                        csv_index = switch_case.get(dt.text)
                        if csv_index != None:
                            car_specs[csv_index] = dds[index].text

                    car_specs_global.append(car_specs)

                    # print(car_specs[0], " ", car_specs[1], " ", car_specs[2], " ", car_specs[3])
            # logging.info(f'Finished model {model_name}.')
        logging.info(f'Done with all from {manufacturer_name}.')

except Exception as e:
    logging.error(
        f'Caught exception "{e}". Saving progress and closing program.')

finally:
    with open('data.csv', 'a', encoding='UTF8', newline='') as f:
        writer = csv.writer(f)
        writer.writerows(car_specs_global)
