<?php

namespace App\Filament\Pages;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class NewApplicationForm extends Component implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;

    public $event;
    public ?array $data = [];

    public function mount($event)
    {
        $this->event = $event;
        
        $this->data = [
            'country' => "",
            'competition_id' => null,
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'phone' => '',
            'address' => [
                'address_line_1' => '',
                'city' => '',
                'state' => '',
                'zip' => '',
            ],
            'meta' => [
                'personal_background' => [
                    'date_of_birth' => '',
                    'age' => '',
                    'height' => '',
                    'weight' => '',
                    'dress_size' => '',
                    'shoe_size' => '',
                    'Attended School/College Name' => '',
                    'List Awards or Achievements (Non Scholastic)' => '',
                    'List Any Degree Attained, Scholarship & Achievement' => '',
                    'Tell us of Any Interesting Facts About Your Family or Their Achievement' => '',
                ],
                'more' => [
                    'social_links' => '',
                    'favorite_color' => '',
                    'favorite_food' => '',
                    'favorite_spot' => '',
                ],
                'outlook' => [
                    'hobbies' => '',
                    'talent' => '',
                    'future_ambitions' => '',
                    'awards' => '',
                    'Most unusual thing You have Done Ever?' => '',
                    'What Person Would You Like To Meet And Why?' => '',
                    'Describe the Moment in Your Life You Are Most Proud of?' => '',
                    'List all of the countries you have travelled to?' => '',
                ],
                'personal_statement' => '',
            ],
            'headshot_photo' => null,
            'waist_up_photo' => null,
            'passport_copy' => null,
            'terms_acceptance_a' => false,
            'terms_acceptance_b' => false,
            'terms_acceptance_c' => false,
            'terms_acceptance_d' => false,
        ];

        $this->form->fill($this->data);
    }

    protected function getFormModel(): string
    {
        return 'application';
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Wizard::make([
                    Step::make('Event Selection')
                        ->icon('heroicon-m-calendar-days')
                        ->schema([
                            Section::make()
                                ->description(new HtmlString($this->getEventHeader()))
                                ->icon('heroicon-o-globe-alt')
                                ->schema([
                                    Select::make('country')
                                        ->label('Select Your Country')
                                        ->searchable()
                                        ->required()
                                        ->live()
                                        ->options($this->getCountryOptions())
                                        ->preload(),

                                    Radio::make('competition_id')
                                        ->label('Select Competition')
                                        ->required()
                                        ->options($this->getCompetitionOptions())
                                        ->descriptions($this->getCompetitionDescriptions())
                                        ->live()
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    Step::make('Personal Information')
                        ->icon('heroicon-m-user-circle')
                        ->schema([
                            Section::make()
                                ->columns(2)
                                ->icon('heroicon-o-identification')
                                ->schema([
                                    TextInput::make('first_name')
                                        ->required()
                                        ->maxLength(255)
                                        ->regex('/^[a-zA-Z\s]*$/')
                                        ->placeholder('Enter your first name'),

                                    TextInput::make('last_name')
                                        ->required()
                                        ->maxLength(255)
                                        ->regex('/^[a-zA-Z\s]*$/')
                                        ->placeholder('Enter your last name'),

                                    TextInput::make('email')
                                        ->email()
                                        ->required()
                                        ->unique('applications', 'email')
                                        ->placeholder('your.email@example.com'),

                                    TextInput::make('phone')
                                        ->tel()
                                        ->required()
                                        ->placeholder('+1234567890'),

                                    Grid::make(4)
                                        ->columnSpanFull()
                                        ->schema([
                                            TextInput::make('address.address_line_1')
                                                ->label('Address Line 1')
                                                ->required()
                                                ->columnSpan(2),
                                            TextInput::make('address.city')
                                                ->required(),
                                            TextInput::make('address.state')
                                                ->required(),
                                            TextInput::make('address.zip')
                                                ->required()
                                                ->columnSpan(1),
                                        ]),
                                ]),
                        ]),

                    Step::make('Background & Statistics')
                        ->icon('heroicon-m-clipboard-document-list')
                        ->schema([
                            Section::make('Vital Statistics')
                                ->icon('heroicon-o-chart-bar')
                                ->columns(3)
                                ->schema([
                                    DatePicker::make('meta.personal_background.date_of_birth')
                                        ->label('Date of Birth')
                                        ->required()
                                        ->maxDate(now()->subYears(18))
                                        ->displayFormat('d/m/Y'),

                                    TextInput::make('meta.personal_background.age')
                                        ->label('Age')
                                        ->numeric()
                                        ->required()
                                        ->minValue(18),

                                    TextInput::make('meta.personal_background.height')
                                        ->label('Height')
                                        ->required(),

                                    TextInput::make('meta.personal_background.weight')
                                        ->label('Weight')
                                        ->required()
                                        ->numeric()
                                        ->suffix('kg'),

                                    TextInput::make('meta.personal_background.dress_size')
                                        ->label('Dress Size')
                                        ->required(),

                                    TextInput::make('meta.personal_background.shoe_size')
                                        ->label('Shoe Size')
                                        ->required(),
                                ]),

                            Section::make('Education & Achievements')
                                ->icon('heroicon-o-academic-cap')
                                ->schema([
                                    TextInput::make('meta.personal_background.Attended School/College Name')
                                        ->label('School/College Name')
                                        ->columnSpanFull(),

                                    Textarea::make('meta.personal_background.List Awards or Achievements (Non Scholastic)')
                                        ->label('Awards & Achievements')
                                        ->columnSpanFull(),

                                    Textarea::make('meta.personal_background.List Any Degree Attained, Scholarship & Achievement')
                                        ->label('Academic Achievements')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    Step::make('Personal Profile')
                        ->icon('heroicon-m-heart')
                        ->schema([
                            Section::make('Social Media & Preferences')
                                ->icon('heroicon-o-share')
                                ->columns(2)
                                ->schema([
                                    Textarea::make('meta.more.social_links')
                                        ->label('Social Media Links')
                                        ->columnSpanFull(),

                                    TextInput::make('meta.more.favorite_color')
                                        ->label('Favorite Color'),

                                    TextInput::make('meta.more.favorite_food')
                                        ->label('Favorite Food'),

                                    TextInput::make('meta.more.favorite_spot')
                                        ->label('Favorite Sports'),
                                ]),

                            Section::make('Personal Outlook')
                                ->icon('heroicon-o-sparkles')
                                ->columns(2)
                                ->schema($this->getPersonalOutlookFields()),
                        ]),

                    Step::make('Documents & Terms')
                        ->icon('heroicon-m-document-text')
                        ->schema([
                            Section::make('Photos & Documents')
                                ->icon('heroicon-o-camera')
                                ->description('Please upload clear, high-quality images')
                                ->schema([
                                    Grid::make(3)
                                        ->schema([
                                            FileUpload::make('headshot_photo')
                                                ->label('Professional Headshot')
                                                ->image()
                                                ->imageEditor()
                                                ->imageEditorAspectRatios(['1:1'])
                                                ->directory('contestants/images')
                                                ->required()
                                                ->maxSize(1024),

                                            FileUpload::make('waist_up_photo')
                                                ->label('Passport Size Photo')
                                                ->image()
                                                ->imageEditor()
                                                ->imageEditorAspectRatios(['1:1'])
                                                ->directory('contestants/images')
                                                ->required()
                                                ->maxSize(1024),

                                            FileUpload::make('passport_copy')
                                                ->label('Passport Copy')
                                                ->image()
                                                ->imageEditor()
                                                ->directory('contestants/documents')
                                                ->required()
                                                ->maxSize(1024),
                                        ]),
                                ]),

                            Section::make('Personal Statement')
                                ->icon('heroicon-o-document-text')
                                ->schema([
                                    RichEditor::make('meta.personal_statement')
                                        ->label('Personal Statement')
                                        ->required()
                                        ->toolbarButtons([
                                            'bold',
                                            'italic',
                                            'link',
                                            'bulletList',
                                            'orderedList',
                                        ])
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Terms & Conditions')
                                ->icon('heroicon-o-clipboard-document-check')
                                ->schema($this->getTermsAndConditionsFields()),
                        ]),
                ])
                ->skippable(false)
                ->submitAction(new HtmlString('<button type="submit" class="inline-flex justify-center items-center gap-1 bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 shadow px-4 py-2 border border-transparent rounded-lg outline-none focus:ring-2 focus:ring-white focus:ring-inset focus:ring-offset-2 focus:ring-offset-primary-700 min-h-[2.25rem] filament-button-size-md font-medium text-white text-sm transition-colors filament-button"><span class="heroicon-m-paper-airplane"></span>Submit Application</button>')),
            ]);
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    protected function getEventHeader(): string
    {
        return "";
        // return '
        //     <div class="mb-8 text-center">
        //         <h1 class="font-bold text-2xl">' . $this->event->name . '</h1>
        //         <div>Application Form</div>
        //         <div class="text-sm">Form Close Date: ' . $this->event->form_end_date->format('M d, Y') . '</div>
        //         <div class="countdown-timer" x-data="timer(' . $this->event->form_end_date->timestamp * 1000 . ')" x-init="init()">
        //             <!-- Add your countdown timer HTML here -->
        //         </div>
        //     </div>
        // ';
    }

    public function getCountryOptions()
    {
        $json = file_get_contents(public_path('countries.json'));
        

        return collect(json_decode($json, true)['data'])
            ->map(fn($item, $key) => [
                'value' => $item['country'],
                'label' => $item['country']
            ])->pluck('value', 'label')->toArray();
    }

    protected function getCompetitionOptions(): array
    {
        return $this->event->competitions->pluck('name', 'id')->toArray();
    }

    protected function getCompetitionDescriptions(): array
    {
        return $this->event->competitions->pluck('description', 'id')->toArray();
    }

    protected function getPersonalOutlookFields(): array
    {
        return [
            TextInput::make('meta.outlook.hobbies')->label('Hobbies'),
            TextInput::make('meta.outlook.talent')->label('Talent'),
            TextInput::make('meta.outlook.future_ambitions')->label('Future Ambitions'),
            TextInput::make('meta.outlook.awards')->label('Awards'),
            Textarea::make('meta.outlook.Most unusual thing You have Done Ever?')
                ->label('Most Unusual Experience')
                ->columnSpanFull(),
            Textarea::make('meta.outlook.What Person Would You Like To Meet And Why?')
                ->label('Dream Meeting')
                ->columnSpanFull(),
            Textarea::make('meta.outlook.Describe the Moment in Your Life You Are Most Proud of?')
                ->label('Proudest Moment')
                ->columnSpanFull(),
        ];
    }

    protected function getTermsAndConditionsFields(): array
    {
        return [
            Checkbox::make('terms_acceptance_a')
                ->label('I hereby agree that the information provided above is true and accurate')
                ->required(),
            Checkbox::make('terms_acceptance_b')
                ->label('I agree to be bound by the terms and conditions of the Pageant')
                ->required(),
            Checkbox::make('terms_acceptance_c')
                ->label(new HtmlString('I have read and accept the <a href="https://mrsheritageinternational.com/repertoire/" target="_blank" class="text-primary-600">Terms of Conditions</a>'))
                ->required(),
            Checkbox::make('terms_acceptance_d')
                ->label(new HtmlString('I agree to follow the <a href="https://mrsheritageinternational.com/repertoire/" target="_blank" class="text-primary-600">competition guidelines</a>'))
                ->required(),
        ];
    }

    public function submit()
    {
        // Validate the form data
        $data = $this->form->getState();

        $this->validate([
            'data.country' => 'required|string',
            'data.competition_id' => 'required|exists:competitions,id',
            'data.first_name' => 'required|string|max:255',
            'data.last_name' => 'required|string|max:255',
            'data.email' => 'required|email|unique:applications,email',
            'data.phone' => 'required|string',
            'data.address.address_line_1' => 'required|string',
            'data.address.city' => 'required|string',
            'data.address.state' => 'required|string',
            'data.address.zip' => 'required|string',
            'data.meta.personal_background.date_of_birth' => 'required|date',
            'data.meta.personal_background.age' => 'required|numeric',
            'data.meta.personal_background.height' => 'required|string',
            'data.meta.personal_background.weight' => 'required|string',
            'data.meta.personal_background.dress_size' => 'required|string',
            'data.meta.personal_background.shoe_size' => 'required|string',
            'data.meta.personal_statement' => 'required|string',
            'data.headshot_photo' => 'required',
            'data.waist_up_photo' => 'required',
            'data.passport_copy' => 'required',
            'data.terms_acceptance_a' => 'required|accepted',
            'data.terms_acceptance_b' => 'required|accepted',
            'data.terms_acceptance_c' => 'required|accepted',
            'data.terms_acceptance_d' => 'required|accepted',
        ]);

        try {
            DB::beginTransaction();

            // Create application using the form data
            $application = \App\Models\Application::create([
                'event_id' => $this->event->id,
                'country' => $data['country'],
                'competition_id' => $data['competition_id'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'meta' => $data['meta'],
                'headshot_photo' => $data['headshot_photo'],
                'waist_up_photo' => $data['waist_up_photo'],
                'passport_copy' => $data['passport_copy'],
                'terms_acceptance_a' => $data['terms_acceptance_a'],
                'terms_acceptance_b' => $data['terms_acceptance_b'], 
                'terms_acceptance_c' => $data['terms_acceptance_c'],
                'terms_acceptance_d' => $data['terms_acceptance_d'],
            ]);

            DB::commit();

            // reset data
            $this->data = [
                'country' => '',
                'competition_id' => '',
                'first_name' => '',
                'last_name' => '',
                'email' => '',
                'phone' => '',
                'address' => [
                    'address_line_1' => '',
                    'city' => '',
                    'state' => '',
                    'zip' => ''
                ],
                'meta' => [
                    'personal_background' => [
                        'date_of_birth' => '',
                        'age' => '',
                        'height' => '',
                        'weight' => '',
                        'dress_size' => '',
                        'shoe_size' => ''
                    ],
                    'personal_statement' => ''
                ],
                'headshot_photo' => '',
                'waist_up_photo' => '',
                'passport_copy' => '',
                'terms_acceptance_a' => false,
                'terms_acceptance_b' => false,
                'terms_acceptance_c' => false,
                'terms_acceptance_d' => false
            ];
            $this->form->fill();
            $this->wizard->setCurrentStep('step-1');

            Notification::make()
                ->title('Application Submitted Successfully')
                ->success()
                ->send();

        
            
        } catch (\Exception $e) {
            DB::rollBack();

            
            
            Notification::make()
                ->title('Error Submitting Application')
                ->danger()
                ->body('Please try again or contact support if the problem persists.')
                ->send();

            throw ValidationException::withMessages([
                'form' => 'Failed to submit application. Please try again.',
            ]);
        }
    }

    public function updated($property, $value): void
    {
        logger("Property updated: {$property} = " . json_encode($value));
    }

    public function render()
    {
        return view('filament.pages.new-application-form');
    }
} 