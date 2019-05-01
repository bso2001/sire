#### Sire -- A Test Data Generator for PHP (version 0.25) ####

Sire is a test data generator written in PHP.  It can be used for non-PHP applications.

##### Features #####

- PHP associative arrays define generation criteria (on a per-field basis)
- Generate object definitions or SQL statements
- Geodata generation: street address, city, state, zip, phone
- "Back references" (eg, make this value dependent on another value previously generated)
- Date generation, including relative calculations (such as, offset by days or hours)
- Lorem Ipsum generation
- Random string generation (with optional prefix and/or suffix
- Random selection from a given domain
- Library of sample images (banners, logos, people)

##### Sire Language #####

Data generation is controlled by a nested array of field definitions (_a la_ Koi).  If a field def contains the key 'generator' then Sire can create test data for the field.

Some sample field definitions:

        [
                'fname' => 'start_date',
                'type' => 'datetime',
                'generator' => 'randomFutureDate'
        ]
        
**randomFutureData** is a Sire function that, well, generates a random date in the future.  Currently, the date format is fixed. (*2015-06-25 10:15:33*, for example; see **To Do** below.)

The other date generators are:

* offsetDateByDays
* offsetDateByHours
* randomDateBetween
* randomDateBeyond

Each of these require additional information to be passed as *params*.  Here's an example:

        [
                'fname' => 'end_date',
                'type' => 'datetime',
                'generator' =>
                [
                        'f' => 'offsetDateByDays',
                        'baseline' => '#start_date',
                        'offset' =>
						[
							'f' => 'random',
							'domain' => range(2, 7)
						]
                ]
        ]
        
In this example, the value of 'generator' is another array, in which 'f' points to the function name.  (In fact, **'generator' => 'randomFutureDate'** is merely shorthand for **'generator' => [ 'f' => 'randomFutureDate' ]**.)

The other elements of the 'generator' array are params passed to the named function.  The example above illustrates two important features.  The 'baseline' param specifies the starting date for the calculation.  In this example, its value (**#start_date**) is a "back reference" that will select the "random future date" previously generated for the start date.  The 'baseline' for any date function can also be the (hopefully self-descriptive) value **@now**.

The 'offset' param specifies the number of days to be added.  Again, its value is an array, and is evaluated like any other Sire value.  The Sire function **random** is called; a random element is chosen from the array specified as the 'domain.'  Note that its value is a call to the PHP range function (which generates the appropriate array).

If a specific function is not known to Sire, it is assumed to be an app-defined routine.

        [       'fname' => 'name',
                'type' => 'string',
                'generator' => '_acaraEventName'
        ]
        
In this example, the app must define a global function called **_acaraEventName**.

Some other Sire generators:

        [
                'fname' => 'description',
                'type' => 'string',
                'generator' =>
                [
                        'f' => 'lorem',
                        'length' => [ 'f' => 'random', 'domain' => range(12, 36) ]
                ]
        ]
The **lorem** routine generates random "lorem ipsum" text; the 'length' param defines the number of words generated.  Other **lorem** params:

        [       'fname' => 'location',
                'type' => 'string',
                'generator' =>
                [
                	'f' => 'lorem',
                	'length' => 1, 
                	'min' => 6,
                	'punct' => false
                ]
        ]

The generated value will have one word containing at least 6 letters.  There will be no punctuation added.

        [
                'fname' => 'website',
                'type' => 'string',
                'generator' =>
                [
                        'f' => 'genstring',
                        'prefix' => 'http://www.',
                        'suffix' =>
						[
							'f' => 'random',
							'domain' => [ '.com', '.net', '.org' ]
						],
                        'length' =>
						[
							'f' => 'random',
							'domain' => range(3, 10)
						]
                ]
        ]

Here's an example of **genstring**.  The 'prefix' and 'suffix' values (if presented) will be appropriately prepended or appended.  (Note the 'suffix' value is again "calculated.")  The 'length' param specifies the number of letters in the generated string.

The "geo generators" are:

* address
* city
* state
* zipCode
* phone

The **zipCode** generator takes a 'stateCode' param to force a reasonable zip code to be generated; its value is likely a back reference:

        [
                'fname' => 'state',
                'type' => 'string',
                'generator' => 'stateCode'
        ],
        [
                'fname' => 'zip',
                'type' => 'string',
                'generator' => [ 'f' => 'zipCode', 'stateCode' => '#state' ]
        ]

There are some "people" generators:

* firstname
* lastname
* birthdate
* username
* company

The **firstname** generator takes an optional 'gender' param, which must be **M**ale, **F**emale, or **A**ny.  The default is **A**.

Lastly, the **randomImage** function returns a local pathname to a random image from the sample pool.  The 'type' param must be one of the following:

* banners
* logos
* people

It is assumed that the application code will do something appropriate with the image (like install it in the right place).


##### To Do #####

* Smart address and/or phone number generation
* Lat/lng generation
* More images
* Programmable date format and more generators
* "genstring" probably needs more params
    
