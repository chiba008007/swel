<?PHP
	$sampletext = "※詳細版をお申込み頂くと全てのコメントをご確認いただけます。";
	$comment = [];
	$comment[2] = [
		'title1'=>"構想力",
		'title2'=>'現状の把握',
		'note2'=>'市場（競合）や顧客および自社の事業、組織に関する具体的な把握情報、課題情報を収集しているかを測定しています。',
		'comment1' => "市場の動向や事業環境の変化に常に敏感に目を配り、その動静をつかむために顧客やパートナーなど関係者からの情報収集をたゆまずされています。",
		'comment2' => "市場の動向や事業環境の変化に比較的目を配り、その動静をつかむために顧客やパートナーなど関係者からの情報収集をされています。",
		'comment3' => "市場の動向や事業環境の変化をつかむ意識が薄いようです。その動静をつかむために顧客やパートナーなど関係者からの情報収集に取り組んでみましょう。",
		'comment4' => "市場の動向や事業環境の変化をつかむ意識に欠けているようです。まずはこうした動向や変化を掴むことがリーダーとして必須であることを認識しましょう。",
		'other1'=>"（強み）市場の動き、世の中のトレンドからいち早く事業の機会を察知できる",
		'other2'=>"（強み）市場の動き、世の中のトレンドに敏感に対応できる",
		'other3'=>"（リスク）市場の動き、世の中のトレンドに出遅れる",
		'other4'=>"（リスク）市場の動き、世の中のトレンドをくみ取ることができないため、事業の方向性を見誤る",
	];
	$comment[3] = [
		'title1'=>"構想力",
		'title2'=>'ビジョンの創造',
		'note2'=>'担当事業（会社）や部門が本来的に成し遂げるべきことや果たすべき使命を理解し、自らの考えとして明確に示しているかを測定しています。',
		'comment1'=>"担当事業（会社）や部門が成し遂げるべきことや果たすべき使命を正しく理解し、めざす姿を自らの考えとして明確に示し、大きな枠組みと高い志をもって、魅力的に描き出しています。",
		'comment2'=>"担当事業（会社）や部門が成し遂げるべきことや果たすべき使命をある程度理解し、めざす姿を自らの考えとして示そうとされています。",
		'comment3'=>"担当事業（会社）や部門が成し遂げるべきことや果たすべき使命を理解しようとする意識が薄いようです。めざす姿を自らの考えとして描き示すよう務めてみましょう。",
		'comment4'=>"担当事業（会社）や部門が成し遂げるべきことや果たすべき使命を理解しようとする意識にか欠けているようです。まずは使命を理解し、その方向性を打ち出すことがリーダーの職務であることを理解しましょう。",
		'other1'=>"（強み）自社の使命と合致したビジョンを描くことができる",
		'other2'=>"（強み）自社の使命を理解し、それと重なるビジョンを持つことができる",
		'other3'=>"（リスク）自社の使命と自身のビジョンが時折ずれることがある",
		'other4'=>"（リスク）自社の使命と異なる方向に進んでしまう。自身のビジョンがない",
	];
	$comment[4] = [
		'title1'=>"構想力",
		'title2'=>'戦略策定と組織形成',
		'note2'=>'既存事業の枠組みや業界の常識にとらわれずゼロベースで発想し、担当機能の業務フロー、商品・サービスの仕掛け・コンセプト等を打ち出しているかを測定しています。',
		'comment1'=>"担当部門（会社）の商品・サービス・コンセプト、業務フローなどの戦略を打ち出し、事業への影響度や緊急度を判断、優先順位をつけながら戦略・戦術へとブレイクダウンしています。具体的な計画や目標数値を策定し、組織の力を最大化する人材・機能の組み方をデザイン、体制を作り上げているでしょう。",
		'comment2'=>"担当部門（会社）の商品・サービス・コンセプト、業務フローなどの戦略を戦術へとブレイクダウンしようとされています。計画や目標数値を設定し、人材・機能の組み方をデザイン、体制を作り上げることを意識されているでしょう。",
		'comment3'=>"担当部門（会社）の戦略を打ち出す意識、事業への影響度や緊急度を判断、優先順位をつけながら戦略・戦術へとブレイクダウンする取り組みを強めたほうがよさそうです。具体的な計画や目標数値を策定し、組織の力を最大化する人材・機能の組み方をデザイン、体制を作り上げる努力をしましょう。",
		'comment4'=>"担当部門（会社）の戦略を打ち出すこと、事業への影響度や緊急度を判断、優先順位をつけながら戦略・戦術へとブレイクダウンすることを意識されていないようです。計画や目標数値を策定し、人材・機能の組み方をデザイン、体制を作り上げることがリーダーとして必須の職務であることを理解しましょう。",
		'other1'=>"（強み）あるべき姿を自ら描き、そこからブレイクダウンして戦略・戦術、組織・人材をデザインできる",
		'other2'=>"（強み）自社の戦略に基づき戦術、組織・人材をデザインできる",
		'other3'=>"（リスク）自社の戦略から戦術、組織・人材に落とし込むことが必ずしも得意でない",
		'other4'=>"（リスク）自社の戦略から戦術、組織・人材に落とし込むことができない",
	];


	$comment[6] = [
		'title1'=>"決断力",
		'title2'=>'事業経営意思決定への参画',
		'note2'=>'担当部門（会社）全体を俯瞰する経営的視点を持って担当部門（会社）のボードに参画し、ともに担当部門（会社）のビジョンや戦略を策定しているかを測定しています。',
		'comment1'=>"担当部門（会社）全体の意思決定に有効な材料を提供し、担当部門（会社）の長やステークホルダーと補完しあいながら積極的に事業運営に関わっています。自分なりのぶれない判断基準を持ち、関係者の利害が一致しない状況においても、ビジョンの実現に向け全体最適となる判断を下しています。",
		'comment2'=>"担当部門（会社）の長やステークホルダーの命を受けて、事業運営に関わっています。自分なりにビジョンの実現に向け判断を下そうとされています。",
		'comment3'=>"担当部門（会社）全体の意思決定に貢献しようという意識、積極的に事業運営の判断に関わる姿勢が薄いようです。自分なりのぶれない判断基準を持ち、関係者の利害が一致しない状況においても、ビジョンの実現に向け全体最適となる判断を下す努力が必要です。",
		'comment4'=>"担当部門（会社）全体の意思決定に貢献しようという意識、事業運営の判断に関わろうという姿勢に欠けているようです。自分なりの判断基準を持ち、ビジョンの実現に向け全体最適となる判断を下そうとすることがリーダーとしての責務であることを理解しましょう。",
		'other1'=>"（強み）意思決定者として適切に行動できる",
		'other2'=>"（強み）意思決定者をサポートする者として参画、行動できる",
		'other3'=>"（リスク）意思決定に参画することが必ずしも適切と思われない",
		'other4'=>"（リスク）意思決定に参画することは難しい",

	];
	$comment[7] = [
		'title1'=>"決断力",
		'title2'=>'多様な利害・意見の中での全体最適判断',
		'note2'=>'関係者の利害が一致しない状況においても、ビジョンの実現に向け全体最適となる判断を下しているかを測定しています。',
		'comment1'=>"担当事業（会社）や部門の現状を客観的・論理的に分析するとともに、多様な情報を収集し将来を洞察することで、解決すべき課題を体系的に明らかにしています。高い視座と広い視野から合理的かつ徹底的に思考することによって、価値を創造しビジョンを実現するための事業戦略や部門戦略を策定し、決断しています。",
		'comment2'=>"担当事業（会社）や部門の現状を把握し、解決すべき課題を明らかにしようという意識があります。ある程度広い視野から事業戦略や部門戦略を策定し、決断しようとしています。",
		'comment3'=>"担当事業（会社）や部門の現状を客観的・論理的に分析すること、多様な情報を収集し将来を洞察することで解決すべき課題を体系的に明らかにする努力を要します。高い視座と広い視野から合理的かつ徹底的に思考することによって、価値を創造しビジョンを実現するための事業戦略や部門戦略を策定し、決断するとよいでしょう。",
		'comment4'=>"担当事業（会社）や部門の現状を客観的・論理的に分析すること、多様な情報を収集し将来を洞察することで解決すべき課題を体系的に明らかにしようという意識に欠けているようです。まずはこうした意識と視野を持ち決断していくことがリーダーとして必須であることを認識しましょう。",
		'other1'=>"（強み）全社最適な意思決定者として的確に行動できる",
		'other2'=>"（強み）全社最適な意思決定ボードに参画、貢献することができる",
		'other3'=>"（リスク）全社最適な意思決定ボードに参画することが必ずしも適切ではない",
		'other4'=>"（リスク）全社最適な意思決定ボードに参画することは難しい",
	];


	$comment[9] = [
		'title1'=>"実行力",
		'title2'=>'戦略の説明、周知、浸透',
		'note2'=>'戦略や方針を自分の言葉で分かりやすく語り、管轄する組織や関係者に向けてメッセージを浸透させているかを測定しています。',
		'comment1'=>"戦略や方針を自分の言葉で分かりやすく語り、管轄する組織や関係者に向けてメッセージを周知しています。戦略が社内メンバーによって確実に実行されるものにするため、策定した戦略を具体的な目標や地に足のついた業務計画へとブレイクダウンできています。",
		'comment2'=>"戦略や方針を自分の言葉で語り、管轄する組織や関係者に向けてメッセージしようとされているようです。戦略が社内メンバーによって実行されるよう、策定した戦略を具体的な目標や地に足のついた業務計画へとブレイクダウンしようという意識があります。",
		'comment3'=>"戦略や方針を自分の言葉で分かりやすく語り、管轄する組織や関係者に向けてメッセージを周知する必要があるでしょう。戦略が社内メンバーによって確実に実行されるものにするため、策定した戦略を具体的な目標や地に足のついた業務計画へとブレイクダウンするよう心がけましょう。",
		'comment4'=>"戦略や方針を自分の言葉で分かりやすく語り、管轄する組織や関係者に向けてメッセージを周知するという意識に欠けているようです。こうしたことが必須で、それにより社内メンバーの実行をうながすことがリーダーの責務であることを理解しましょう。",
		'other1'=>"（強み）戦略の企画立案者、発信者および実行としてリーダーシップを発揮し任に当たれる",
		'other2'=>"（強み）決定された戦略の発信者、実行推進者として適切に行動できる",
		'other3'=>"（リスク）戦略を伝え、実行するリーダーとして課題を抱える可能性がある",
		'other4'=>"（リスク）戦略を伝え、実行するリーダーとしての役割は難しい",

	];
	$comment[10] = [
		'title1'=>"実行力",
		'title2'=>'戦略の果断な遂行',
		'note2'=>'いかに困難あるいは不確実な状況にあっても自らの責任において敢然と決断し、不測の事態にも冷静かつ柔軟に対処しながら、強い意思や信念を持って、組織の変革を遂行しているかを測定しています。',
		'comment1'=>"困難あるいは不確実な状況にあっても自らの責任において敢然と決断し、職責を完遂するという強い意思を持っています。ビジョン・戦略の実行が困難な状況でも、メンバー、社内外の関係者に適宜権限の付与や働きかけを行い、実現に向けて最後までやり遂げることができているでしょう。戦略や戦術・施策の結果を客観的にとらえ、成功・失敗要因を明らかにしてその後の戦略に生かすことができています。",
		'comment2'=>"困難あるいは不確実な状況にあっても自らの責任において決断し、職責を完遂しようという意識があります。メンバー、社内外の関係者に適宜権限の付与や働きかけを行い、実現に向けてやり遂げようと努力されているでしょう。戦略や戦術・施策の結果から成功・失敗要因を明らかにしてその後の戦略に生かそうという意識があります。",
		'comment3'=>"困難あるいは不確実な状況で自らの責任において敢然と決断し、不測の事態にも冷静かつ柔軟に対処しながら職責を完遂するという強い意思を持つ努力が必要です。ビジョン・戦略の実行が困難な状況でも、メンバー、社内外の関係者に適宜権限の付与や働きかけを行い、実現に向けて最後までやり遂げる意志が求められます。",
		'comment4'=>"困難あるいは不確実な状況で自らの責任において敢然と決断し、不測の事態にも冷静かつ柔軟に対処しながら職責を完遂するという強い意思を持つことが大事だという意識に欠けているようです。それなくして、実現に向けて最後までやり遂げる意志を持ち実行をマネジメントするリーダーとしての職務を果たすことは難しいことを理解しましょう。",
		'other1'=>"（強み）戦略の実行者として困難を乗り越え、完遂することができる",
		'other2'=>"（強み）戦略の実行者として困難に立ち向かい、やりとげようという気持ちがある",
		'other3'=>"（リスク）戦略の実行者として困難に立ち向かい、やりとげることが難しい場合がある",
		'other4'=>"（リスク）戦略の実行者として困難に立ち向かい、やりとげることは難しい",
	];
	$comment[11] = [
		'title1'=>"実行力",
		'title2'=>'業績へのコミット',
		'note2'=>'いかに困難な状況にあっても、必ず業績を完遂することに責任を持ち、自らの信じるところに従って行動し、迫力と粘りでさまざまな障害を克服しているかを測定しています。',
		'comment1'=>"いかに困難な状況にあっても、自らの信じるところに従って行動し、必ず業績をあげることにコミットできています。両立困難な矛盾する要請に直面しても、双方納得させうるビジョンの実現に向け全体最適となる判断を下し達成させています。事の成否に関わらず、自らがとった判断や行動に責任をもち、その理由と結果を明確かつ論理的に説明できているでしょう。",
		'comment2'=>"困難な状況にあっても、自らの考えで行動し、業績をあげようとされているでしょう。ビジョンの実現に向け全体最適となる判断を下し達成しようという意識があります。自らがとった判断や行動に責任をもち、その理由と結果を説明しようという意識があるでしょう。",
		'comment3'=>"いかに困難な状況にあっても、自らの信じるところに従って行動し、必ず業績をあげることにコミットすることが必要です。全体最適となる判断を下し達成しようという意識、事の成否に関わらず、自らがとった判断や行動に責任をもち、その理由と結果を明確かつ論理的に説明することに努めましょう。",
		'comment4'=>"いかに困難な状況にあっても、自らの信じるところに従って行動し、必ず業績をあげることにコミットすることが必要であるという意識が欠けているようです。自らがとった判断や行動に責任をもち、その理由と結果を明確かつ論理的に説明することがリーダーの責務であることをまず理解しましょう。",
		'other1'=>"（強み）業績にコミットし達成させる力を持つ",
		'other2'=>"（強み）業績にコミットし達成させようと努力できる",
		'other3'=>"（リスク）業績にコミットし達成させることを必ずしも全うできていない",
		'other4'=>"（リスク）業績にコミットし達成させるような役割は向いていない",

	];



	$comment[13] = [
		'title1'=>"リーダーシップ力",
		'title2'=>'信頼の獲得',
		'note2'=>'率直で開かれたコミュニケーションによって、信頼関係を構築し、メンバーや関係者の意見を引き出しているかを測定しています。',
		'comment1'=>"高い倫理意識を持ち、自らの行動指針や理念を明確化できています。常に率直にものを言える安心・安全の場を確保し、率直でオープンなコミュニケーションによって、メンバーや関係者の意見を引き出しているでしょう。高度な遵法精神や倫理性・社会性を備えた言行一致の誠実な態度と、高潔さや私心のない姿勢によって、さまざまな利害関係者との信頼ある人間関係を構築しているようです。自らの意思や考えを、摩擦や軋轢をおそれず明確に述べながらも、質問や批判に率直かつ堂々と答えることによって、利害関係者の理解と支持を取り付け、ステークホルダーと必ずしも利害が一致しない場合であっても、信頼関係を維持、継続する努力をしています。",
		'comment2'=>"自らの行動指針や理念を明確化しようとされています。率直にものを言える安心・安全の場を確保し、率直でオープンなコミュニケーションによって、メンバーや関係者の意見を引き出そうと努力されているでしょう。私心のない姿勢によって、さまざまな利害関係者との信頼ある人間関係を構築しようとされているようです。自らの意思や考えを述べながらも、質問や批判にも答えることによって、利害関係者の理解と支持を取り付けよう、ステークホルダーと必ずしも利害が一致しない場合であっても、信頼関係を維持、継続する努力をされているようです。",
		'comment3'=>"高い倫理意識を持ち、自らの行動指針や理念を明確化するよう努めましょう。常に率直にものを言える安心・安全の場を確保し、率直でオープンなコミュニケーションによって、メンバーや関係者の意見を引き出すことが重要です。言行一致の誠実な態度と、高潔さや私心のない姿勢によって、さまざまな利害関係者からとの信頼ある人間関係を構築すること。自らの意思や考えを、摩擦や軋轢をおそれず明確に述べながらも、質問や批判に率直かつ堂々と答えることによって、利害関係者の理解と支持を取り付け、ステークホルダーと必ずしも利害が一致しない場合であっても、信頼関係を維持、継続する努力を続けましょう。",
		'comment4'=>"高い倫理意識を持ち、自らの行動指針や理念を明確化することができていないようです。常に率直にものを言える安心・安全の場を確保し、率直でオープンなコミュニケーションによって、メンバーや関係者の意見を引き出すことが重要であることをまずリーダーとして理解しましょう。言行一致の誠実な態度と、高潔さや私心のない姿勢によって、さまざまな利害関係者からとの信頼ある人間関係を構築すること。自らの意思や考えを、摩擦や軋轢をおそれず明確に述べながらも、質問や批判に率直かつ堂々と答えることによって、利害関係者の理解と支持を取り付け、ステークホルダーと必ずしも利害が一致しない場合であっても、信頼関係を維持、継続する努力を続けることがリーダーの責務であることを認識しましょう。",
		'other1'=>"（強み）リーダーとしての高い次元の信望を得ることができる",
		'other2'=>"（強み）リーダーとしての信望を得ることができる",
		'other3'=>"（リスク）リーダーとしての信望を得ることが必ずしもできていない",
		'other4'=>"（リスク）リーダーとしての信望を得ることは難しい",

	];
	$comment[14] = [
		'title1'=>"リーダーシップ力",
		'title2'=>'組織リードと育成',
		'note2'=>'メンバーの状況に気を配り、タイムリーに相手に合った助言や指導を行い成長を促しているかを測定しています。',
		'comment1'=>"管轄するメンバーたちが自ら意識を高め成長していくための、効果的な仕組みや場を提供できています。メンバーたちの状況に気を配り、タイムリーに相手に合った助言や指導を行い成長を促すことができているでしょう。",
		'comment2'=>"管轄するメンバーたちが自ら意識を高め成長していくための仕組みや場を提供しようと意識されています。メンバーたちの状況に気を配り、相手に合った助言や指導を行い成長を促そうと務めていらっしゃるでしょう。",
		'comment3'=>"管轄するメンバーたちが自ら意識を高め成長していくための、効果的な仕組みや場を提供する努力が必要です。メンバーたちの状況に気を配り、タイムリーに相手に合った助言や指導を行い成長を促していくとよいでしょう。",
		'comment4'=>"管轄するメンバーたちが自ら意識を高め成長していくための仕組みや場を提供するという意識に欠けているようです。メンバーたちの状況に気を配り、タイムリーに相手に合った助言や指導を行い成長を促していくことがリーダーの責務であることを理解しましょう。",
		'other1'=>"（強み）メンバーを活かし成長させる組織、場づくり、指導ができる",
		'other2'=>"（強み）メンバーを活かし成長させようという意識がある",
		'other3'=>"（リスク）メンバーを活かし成長させようという意識、行動に欠ける部分がある",
		'other4'=>"（リスク）メンバーを活かし成長させることは難しい",
	];
	$comment[15] = [
		'title1'=>"リーダーシップ力",
		'title2'=>'人と組織の能力開発',
		'note2'=>'多様な価値観を尊重し、さまざまな意見や考えあるいはナレッジを交換し合うことを通じて、創造性や革新性などの会社全体の組織能力を高めているかを測定しています。',
		'comment1'=>"個々人の能力を考慮した適切な権限委譲を行うとともに、各人に適合した学習と成長の機会を提供し、全社としての後継人材の育成を図っています。多様な価値観を尊重し、さまざまな意見や考えあるいは知識を交換し合うことを通じて、創造性や革新性などの組織能力を高めているでしょう。組織が望ましい状況や動きとなるよう、同列の幹部、上役となる経営トップやオーナー、経営陣らへも主体的に働きかけています。",
		'comment2'=>"個々人の能力を考慮した権限委譲を行い、各人に適した学習と成長の機会を提供しています。多様な価値観を尊重し、さまざまな意見や考えあるいは知識を交換し合うことを通じて、創造性や革新性などの組織能力を高めていこうという意識をお持ちでしょう。組織が望ましい状況や動きとなるよう、同列の幹部、上役となる経営トップやオーナー、経営陣らに働きかけることの大事さも認識されています。",
		'comment3'=>"個々人の能力を考慮した適切な権限委譲を行い、各人に適合した学習と成長の機会を提供、全社としての後継人材の育成を図る必要があります。多様な価値観を尊重し、さまざまな意見や考えあるいは知識を交換し合うことを通じて、創造性や革新性などの組織能力を高めていきましょう。組織が望ましい状況や動きとなるよう、同列の幹部、上役となる経営トップやオーナー、経営陣らへも主体的に働きかけることが欠かせません。",
		'comment4'=>"個々人の能力を考慮した適切な権限委譲を行い、各人に適合した学習と成長の機会を提供、全社としての後継人材の育成を図ることの重要性を認識されていません。また、組織が望ましい状況や動きとなるよう、同列の幹部、上役となる経営トップやオーナー、経営陣らへも主体的に働きかけることもリーダーとしての責務であることを、まず認識しましょう。",
		'other1'=>"（強み）メンバー、ステークホルダーそれぞれの主体性や価値観、意見を活かした創造的な組織運営ができる",
		'other2'=>"（強み）メンバー、ステークホルダーそれぞれの主体性や価値観、意見を活かそうという意識がある",
		'other3'=>"（リスク）メンバー、ステークホルダーそれぞれの主体性や価値観、意見を活かした創造的な組織運営は必ずしも得意でない",
		'other4'=>"（リスク）メンバー、ステークホルダーそれぞれの主体性や価値観、意見を活かした創造的な組織運営は苦手である",

	];


	$comment[17] = [
		'title1'=>"学習・自己成長力",
		'title2'=>'外部からの知見吸収による自己の成長',
		'note2'=>'過去の蓄積に頼ることなく新しい知見を外部から貪欲に吸収し、事業経営を担う一員として自己を成長させている。',
		'comment1'=>"過去の蓄積に頼るばかりでなく、新しい知見・技術や手法を外部から貪欲に吸収し、事業経営を担う一員として自己を成長させています。自らの見解だけに固執することなく、多様な考え方を柔軟に取り入れ視界を広げているでしょう。",
		'comment2'=>"新しい知見・技術や手法を外部から吸収し、事業経営を担う一員として自己を成長させようという意識があります。自らの見解だけに固執することなく、多様な考え方を柔軟に取り入れ視界を広げていきましょう。",
		'comment3'=>"過去の蓄積に頼るばかりでなく、新しい知見・技術や手法を外部から貪欲に吸収し、事業経営を担う一員として自己を成長させていきましょう。自らの見解だけに固執することなく、多様な考え方を柔軟に取り入れ視界を広げていくことが大事です。",
		'comment4'=>"過去の蓄積に頼るばかりでなく、新しい知見・技術や手法を外部から貪欲に吸収し、事業経営を担う一員として自己を成長させていくことがリーダーとして必須であることを認識しましょう。自らの見解だけに固執することなく、多様な考え方を柔軟に取り入れ視界を広げていくことができる人がリーダーとして成長し活躍の場を中長期的に獲得していきます。",
		'other1'=>"（強み）常に新しい知識・技術を様々な方面から学び取り入れ事業に反映できる",
		'other2'=>"（強み）新しい知識・技術を様々な方面から学び取り入ようという意識がある",
		'other3'=>"（リスク）新しい知識・技術を様々な方面から学び取り入ようという意識が弱い",
		'other4'=>"（リスク）新しい知識・技術を様々な方面から学び取り入ようという意識がない、苦手である",

	];
	$comment[18] = [
		'title1'=>"学習・自己成長力",
		'title2'=>'不断の学びと経営・事業への連結',
		'note2'=>'新たな知識・技術や手法を不断に学び習得し、経営に見識を持つとともに事業に精通している',
		'comment1'=>"学んだ知識・技術や手法を事業や経営、現場の業務で実際に活用できており、部下や同僚、上役に積極的に共有することに務めています。事業や経営、現場での業務で活用することを前提において、関連する知識・技術や手法を学ぶことに常に注力しているでしょう。",
		'comment2'=>"学んだ知識・技術や手法を事業や経営、現場の業務で活用しようという意識があり、部下や同僚、上役にも共有することの大切さを認識しています。事業や経営、現場での業務で活用することを前提において、関連する知識・技術や手法を学ぶことに更に注力していくとよいでしょう。",
		'comment3'=>"学んだ知識・技術や手法を事業や経営、現場の業務で実際に活用し、部下や同僚、上役に積極的に共有することに務めましょう。事業や経営、現場での業務で活用することを前提において、関連する知識・技術や手法を学ぶことに常に注力していくことが必須です。",
		'comment4'=>"学んだ知識・技術や手法を事業や経営、現場の業務で実際に活用すること、部下や同僚、上役に積極的に共有することが重要であることの認識に欠けているようです。事業や経営、現場での業務で活用することを前提において、関連する知識・技術や手法を学ぶことに注力していくことがリーダーとして必須であることを、まず認識しましょう。",
		'other1'=>"（強み）知識・技術を実践的に学び、周囲にも共有し、実務に活かすことができる",
		'other2'=>"（強み）知識・技術を実践的に学ぼうという意識がある",
		'other3'=>"（リスク））知識・技術を実践的に学ぶ姿勢と行動が弱い",
		'other4'=>"（リスク）知識・技術を実践的に学ぶということができない",
	];


	$ampwhere = [];
	$ampwhere['testpaper_id'] = $testdata[ 'id' ];
	$ampdata = $objw->getAmpPdf($ampwhere);

	//構想力
	//表示用
	$hensa1 = round($ampdata[ 'hensa1' ],1);
	$disp1 = ratio(((round($ampdata[ 'hensa1' ],1)-20)/10));
	$hensa5 = round($ampdata[ 'hensa5' ],1);
	$disp5 = ratio((round($ampdata[ 'hensa5' ],1)-20)/10);
	$hensa8 = round($ampdata[ 'hensa8' ],1);
	$disp8 = ratio((round($ampdata[ 'hensa8' ],1)-20)/10);
	$hensa12 = round($ampdata[ 'hensa12' ],1);
	$disp12 = ratio((round($ampdata[ 'hensa12' ],1)-20)/10);
	$hensa16 = round($ampdata[ 'hensa16' ],1);
	$disp16 = ratio((round($ampdata[ 'hensa16' ],1)-20)/10);




	function ratio($num){

		return $num;
	}
	//要素用配列の値を表示
	//上下3要素ずつ
	$sort[2] = $ampdata[ 'hensa2' ];
	$sort[3] = $ampdata[ 'hensa3' ];	
	$sort[4] = $ampdata[ 'hensa4' ];
	$sort[6] = $ampdata[ 'hensa6' ];
	$sort[7] = $ampdata[ 'hensa7' ];
	$sort[9] = $ampdata[ 'hensa9' ];
	$sort[10] = $ampdata[ 'hensa10' ];
	$sort[11] = $ampdata[ 'hensa11' ];
	$sort[13] = $ampdata[ 'hensa13' ];
	$sort[14] = $ampdata[ 'hensa14' ];
	$sort[15] = $ampdata[ 'hensa15' ];
	$sort[17] = $ampdata[ 'hensa17' ];
	$sort[18] = $ampdata[ 'hensa18' ];
	asort($sort);
	$under = array_slice($sort,0,2,true);
	arsort($sort);
	$top = array_slice($sort,0,2,true);


	$avghensa = round(($hensa1+$hensa5+$hensa8+$hensa12+$hensa16)/5,1);
	$avgdisp = ($disp1+$disp5+$disp8+$disp12+$disp16)/5;

	$DataSet = new pData;
	$DataSet->AddPoint(array("Memory","Disk","Network","Slots","CPU"),"Label");
	$DataSet->AddPoint(array($disp1,$disp5,$disp8,$disp12,$disp16),"Serie1");
	$DataSet->AddPoint(array($avgdisp,$avgdisp,$avgdisp,$avgdisp,$avgdisp),"Serie2");
	$DataSet->AddSerie("Serie1");
	$DataSet->AddSerie("Serie2");

	// Initialise the graph
	$Test = new pChart(600,600);
	$Test->setFontProperties("Fonts/tahoma.ttf",1);
	$Test->setGraphArea(30,30,570,570);
	$Test->setColorPalette(0,79,129,189);
	// Draw the radar graph
	$Test->drawRadarAxis($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE, 2, 120, 120, 120, 230, 230,230,6);
	$Test->drawFilledRadar($DataSet->GetData(),$DataSet->GetDataDescription(),0,0,6);

	
	// Finish the graph
	$Test->setFontProperties("Fonts/tahoma.ttf",10);

	$mvimg_main = "./images/pdf/pdf37/mv_graf_main".$user[0][ 'login_id' ].".png";
	$Test->render($mvimg_main);




	$hensa2 = round($ampdata[ 'hensa2' ],1);
	$disp2 = ratio(((round($ampdata[ 'hensa2' ],1)-20)/10));
	$hensa3 = round($ampdata[ 'hensa3' ],1);
	$disp3 = ratio(((round($ampdata[ 'hensa3' ],1)-20)/10));
	$hensa4 = round($ampdata[ 'hensa4' ],1);
	$disp4 = ratio(((round($ampdata[ 'hensa4' ],1)-20)/10));
	$hensa6 = round($ampdata[ 'hensa6' ],1);
	$disp6 = ratio(((round($ampdata[ 'hensa6' ],1)-20)/10));
	$hensa7 = round($ampdata[ 'hensa7' ],1);
	$disp7 = ratio(((round($ampdata[ 'hensa7' ],1)-20)/10));
	$hensa9 = round($ampdata[ 'hensa9' ],1);
	$disp9 = ratio(((round($ampdata[ 'hensa9' ],1)-20)/10));
	$hensa10 = round($ampdata[ 'hensa10' ],1);
	$disp10 = ratio(((round($ampdata[ 'hensa10' ],1)-20)/10));
	$hensa11 = round($ampdata[ 'hensa11' ],1);
	$disp11 = ratio(((round($ampdata[ 'hensa11' ],1)-20)/10));
	$hensa13 = round($ampdata[ 'hensa13' ],1);
	$disp13 = ratio(((round($ampdata[ 'hensa13' ],1)-20)/10));
	$hensa14 = round($ampdata[ 'hensa14' ],1);
	$disp14 = ratio(((round($ampdata[ 'hensa14' ],1)-20)/10));
	$hensa15 = round($ampdata[ 'hensa15' ],1);
	$disp15 = ratio(((round($ampdata[ 'hensa15' ],1)-20)/10));
	$hensa17 = round($ampdata[ 'hensa17' ],1);
	$disp17 = ratio(((round($ampdata[ 'hensa17' ],1)-20)/10));
	$hensa18 = round($ampdata[ 'hensa18' ],1);
	$disp18 = ratio(((round($ampdata[ 'hensa18' ],1)-20)/10));



	$array_hensa2 = [
		$hensa2,$hensa3,$hensa4,$hensa6,$hensa7,$hensa9,$hensa10,$hensa11,$hensa13,$hensa14,$hensa15,$hensa17,$hensa18
	];
	$array_disp2 = [
		$disp2,$disp3,$disp4,$disp6,$disp7,$disp9,$disp10,$disp11,$disp13,$disp14,$disp15,$disp17,$disp18
	];
	$avghensa2 = round(array_sum($array_hensa2)/count($array_hensa2),1);
	$avgdisp2 = array_sum($array_disp2)/count($array_disp2);
	
	if ($testdata[ 'ampflag' ] != 1){
		$array_disp2 = [];
		$avgdisp2 = 2.5;
	}

	$DataSet = new pData;
	$DataSet->AddPoint(array("Memory","Disk","Network","Slots","CPU"),"Label");
	$DataSet->AddPoint($array_disp2,"Serie1");

	$DataSet->AddPoint(array(
		$avgdisp2,
		$avgdisp2,
		$avgdisp2,
		$avgdisp2,
		$avgdisp2,
		$avgdisp2,
		$avgdisp2,
		$avgdisp2,
		$avgdisp2,
		$avgdisp2,
		$avgdisp2,
		$avgdisp2,
		$avgdisp2,
	),"Serie2");

	$DataSet->AddSerie("Serie1");
	$DataSet->AddSerie("Serie2");

	// Initialise the graph
	$Test = new pChart(600,600);
	$Test->setFontProperties("Fonts/tahoma.ttf",1);
	$Test->setGraphArea(30,30,570,570);
	$Test->setColorPalette(0,79,129,189);
	// Draw the radar graph
	$Test->drawRadarAxis($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE, 2, 120, 120, 120, 230, 230,230,6);
	$Test->drawFilledRadar($DataSet->GetData(),$DataSet->GetDataDescription(),0,0,6);
	// Finish the graph
	$Test->setFontProperties("Fonts/tahoma.ttf",10);
	$mvimg_main2 = "./images/pdf/pdf37/mv_graf_main2".$user[0][ 'login_id' ].".png";
	$Test->render($mvimg_main2);


	$cus_name  = $testdata[ 'cusname'  ];
	$exam_date  = substr(preg_replace("/-/","/",$testdata[ 'exam_dates'  ]),0,10);
	$name       = $testdata[ 'name'       ];
	$kana       = $testdata[ 'kana'       ];
	$sexs       = $a_gender[$testdata[ 'sex'        ]];
	$age        = calc_age($testdata[ 'birth' ],$exam_date);


	$logo = "/img/pdflogo/pl_".$user[0][ 'login_id' ].".jpg";
	if(!file_get_contents($logo)){
		$logo = "/images/welcome.jpg";
	}

	$mpdf = new mPDF('ja', 'A4', 0, '', 10, 10, 5, 5, 9, 9);
	$mpdf->ignore_invalid_utf8 = true;



	$tbl = "";
	foreach($top as $key=>$value){
		if($value > 55){
			$cmt = $comment[$key][ 'comment1' ];
		}else{
			$cmt = $comment[$key][ 'comment2' ];
		}
		$tbl .= "
		<tr>
			<td class='w200 purple c'>
			(".$comment[$key][ 'title1' ].")<br />
			".$comment[$key][ 'title2' ]."
			</td>
			<td>".$cmt."</td>
		</tr>
		";
	}

	$tbl2 = "";
	foreach($under as $key=>$value){
		if($value < 45){
			$cmt = $comment[$key][ 'comment4' ];
		}else{
			$cmt = $comment[$key][ 'comment3' ];
		}

		$tbl2 .= "
		<tr>
			<td class='w200 pink c'>
			(".$comment[$key][ 'title1' ].")<br />
			".$comment[$key][ 'title2' ]."
			</td>
			<td>".$cmt."</td>
		</tr>
		";
	}

	$style = "
	<style type='text/css'>
		.border{
			border:1px solid #000;
			border-collapse: collapse;
			width:100%;
		}
		.green{
			background-color:#ccffcc;
			padding:3px;
			text-align:center;
			border:1px solid #000;
		}
		.w{
			background-color:#fff;
			padding:3px;
			text-align:center;
			border:1px solid #000;
		}
		.box{
			border:1px solid #ccc;
			padding:10px;
		}
		.box2{
			border:1px solid #ccc;
			text-align:center;
		}
		.box3{
			border:1px solid #ccc;
			text-align:center;
			height:620px;
		}
		.w60p{width:60%;}
		.mt10{margin-top:10px;}
		.ex{
			border:1px solid #000;
			padding:5px;
			position:absolute;
			top:290px;
			left:500px;
			width:230px;
		}
		.ex2{
			border:1px solid #000;
			padding:2px 5px;
			position:absolute;
			top:990px;
			left:430px;
			width:290px;
		}
		.fleft{
			float:left;	
		}
		.line1{
			padding-left:60px;
			padding-top:-10px;
		}
		.line2{
			padding-left:60px;
			padding-top:-10px;
		}
		.pt10{padding-top:10px;}
		.pt20{padding-top:20px;}
		.w5{width:5px;}
		.w10{width:10px;}
		.w20{width:20px;}
		.w30{width:30px;}
		.w50{width:50px;}
		.w60{width:60px;}
		.w80{ width:80px;}
		.w90{ width:90px;height:100px;}
		.w100{ width:100px;}
		.w120{ width:120px;}
		.w140{ width:140px;}
		.w150{ width:150px;}
		.w160{ width:160px;}
		.w200{ width:200px;}
		.w240{ width:240px;}
		.w400{ width:400px;}
		.w700{ width:700px;}
		.w10p{ width:10%;}
		.w40p{ width:40%;}
		.w80p{ width:80%;}
		.ab{position:absolute;}
		.graph{height:20px;background-color:#4169e1;}
		.t1{position:absolute;top:290px;left:360px;}
		.t2{position:absolute;top:420px;left:590px;}
		.t3{position:absolute;top:660px;left:490px;}
		.t4{position:absolute;top:660px;left:220px;}
		.t5{position:absolute;top:420px;left:130px;}
		.n1{position:absolute;top:495px;left:385px;width:50px;font-size:9px;}
		.n2{position:absolute;top:470px;left:385px;width:50px;font-size:9px;}
		.n3{position:absolute;top:440px;left:385px;width:50px;font-size:9px;}
		.n4{position:absolute;top:405px;left:385px;width:50px;font-size:9px;}
		.n5{position:absolute;top:375px;left:385px;width:50px;font-size:9px;}
		.n6{position:absolute;top:345px;left:385px;width:50px;font-size:9px;}
		.n7{position:absolute;top:315px;left:385px;width:50px;font-size:9px;}
		
		.t11{position:absolute;top:510px;left:380px;}
		.t12{position:absolute;top:540px;left:480px;}
		.t13{position:absolute;top:600px;left:580px;}
		.t21{position:absolute;top:700px;left:620px;}
		.t22{position:absolute;top:830px;left:580px;}
		.t31{position:absolute;top:920px;left:530px;}
		.t32{position:absolute;top:960px;left:440px;}
		.t33{position:absolute;top:960px;left:220px;}
		.t41{position:absolute;top:920px;left:140px;}
		.t42{position:absolute;top:830px;left:60px;}
		.t43{position:absolute;top:700px;left:50px;}
		.t51{position:absolute;top:600px;left:50px;}
		.t52{position:absolute;top:540px;left:80px;}

		.n21{position:absolute;top:740px;left:385px;width:50px;}
		.n22{position:absolute;top:710px;left:385px;width:50px;}
		.n23{position:absolute;top:675px;left:385px;width:50px;}
		.n24{position:absolute;top:640px;left:385px;width:50px;}
		.n25{position:absolute;top:600px;left:385px;width:50px;}
		.n26{position:absolute;top:570px;left:385px;width:50px;}
		.n27{position:absolute;top:540px;left:385px;width:50px;}

		.table1{
			border:1px solid #000;
			border-collapse: collapse;
			width:100%;
		}
		.table1 td{
			border:1px solid #000;
			border-collapse: collapse;
			font-size:9px;
			height:70px;
			padding:2px;
		}
		.table2{
			border:1px solid #000;
			border-collapse: collapse;
		}
		.table2 td{
			border:1px solid #000;
			border-collapse: collapse;
			height:30px;
			padding:2px;
		}
		.table3{
			border:1px solid #000;
			border-collapse: collapse;
			width:760px;
		}
		.table3 th{
			border:1px solid #000;
			border-collapse: collapse;
			height:30px;
			padding:2px;
			background-color:#4169e1;
			color:#fff;
			white-space: nowrap;

		}
		.table3 td{
			border:1px solid #000;
			border-collapse: collapse;
			padding:2px;
			background-color:#f0ffff;
			height:100px;
			font-size:12px;
			word-break:break-all;
		}
		.c{
			text-align:center;
		}
		.purple{background-color:#e6e6fa;}
		.pink{background-color:#ffb6c1;}
		.gray{background-color:#dcdcdc;}
		.red{background-color:#ff7f50;}
		.light{background-color:#f0ffff;}
		.tate{
			writing-mode: vertical-rl;
      text-orientation: upright;
			width:10px;
		}
		.footer{
			position:absolute;
			bottom:0;
			right:0;
		}
		#sendbox{
			border:1px solid #000;
			position:absolute;
			padding:10px;
			width:300px;
			top:710px;
			left:230px;
			background-color:#ccc;
			text-align:center;
			z-index:1000;
		}
		#pipe1{
			position:absolute;
			top:330;
			left:43;
			font-size:11px;
		}
		#pipe2{
			position:absolute;
			top:357;
			left:43;
			font-size:11px;
		}


	</style>
	";


	$examarea = "
	<p>".$testdata[ 'cusname' ]."</p>
	<table class='border'>
			<tr>
				<td class='green'>受検日</td>
				<td class='w'>$exam_date</td>
				<td class='green'>受検者ID</td>
				<td class='w'>".$testdata['exam_id']."</td>
				<td class='green'>氏名</td>
				<td class='w'>$name($kana)</td>
				<td class='green'>年齢</td>
				<td class='w'>$age</td>
			</tr>
	</table>
	";

	$header = "
	<div style='float:left;width:300px;margin-top:0;'><img src='".$logo."' height=50 ></div>
	<div style='float:right;width:400px;text-align:right;padding-top:20px;'>
	経営人材度アセスメント結果<small>(個人結果報告書:まとめ)Ver1.3</small>
	</div>
	<br clear=all />
	".$examarea;

	$footer = "Copyright ©2010-2022 KEIEISHA JP Corporation All Rights Reserved";

	$contents = $style."
	".$header."
	
	<div class='mt10'>1.経営人材度検査で測定していること</div>
	<div class='box mt10'>
		本検査は、受検者が日頃発揮している５つの力「構想力」・「決断力」・「実行力」・「リーダーシップ力」・「学習力」を測定しています。
	</div>
	<div class='mt10'>2.経営人材に必要な５つの力のレベル</div>
	<div class='box2 mt10'>
		<img src='$mvimg_main' style='padding-top:30px;' width=400 />
	</div>

	<div class='t1'>構想力($hensa1)</div>
	<div class='t2'>決断力($hensa5)</div>
	<div class='t3'>実行力($hensa8)</div>
	<div class='t4'>リーダーシップ力($hensa12)</div>
	<div class='t5'>学習力($hensa16)</div>
	<div class='n1'>20</div>
	<div class='n2'>30</div>
	<div class='n3'>40</div>
	<div class='n4'>50</div>
	<div class='n5'>60</div>
	<div class='n6'>70</div>
	<div class='n7'>80</div>
	
	<div class='ex'>
	凡例<br clear=all />
		<div class='w240 pt10'>
			<img src='/images/pdf/pdf37/blueline.png' />
			<div class='line1'>あなたの結果</div>
		</div>
		<div class='w240 pt10'>
			<img src='/images/pdf/pdf37/redline.png' />
			<div class='line2'>あなたの5要素平均値($avghensa)</div>
		</div>
		<div class='w240 pt10'>
			<div class='line2'>受検者全体平均値(50.0)</div>
		</div>
	</div>
	<div class='pt10'>
	3.".$testdata['name']."さんの診断結果
	</div>
	<div class='pt10'>
		上位要素
		<table class='table1'>
		$tbl
		</table>
	</div>
	<div class='pt10'>
		下位要素
		<table class='table1'>
		$tbl2
		</table>
	</div>
	<div class='footer'>".$footer."</div>";

	
	

	$w1 = ($hensa1-20)*7.2+18;
	$w5 = ($hensa5-20)*7.2+18;
	$w8 = ($hensa8-20)*7.2+18;
	$w12 = ($hensa12-20)*7.2+18;
	$w16 = ($hensa16-20)*7.2+18;

	if($avghensa <=30 ){ $left = ($avghensa-20)*7.5+305; }
	else{ $left = ($avghensa-20)*7.2+305; }
	
	$bar1 = "<div class='ab graph' style='top:305px;left:290px;width:".$w1."px;'></div>";
	$bar2 = "<div class='ab graph' style='top:332px;left:290px;width:".$w5."px;'></div>";
	$bar3 = "<div class='ab graph' style='top:359px;left:290px;width:".$w8."px;'></div>";
	$bar4 = "<div class='ab graph' style='top:386px;left:290px;width:".$w12."px;'></div>";
	$bar5 = "<div class='ab graph' style='top:413px;left:290px;width:".$w16."px;'></div>";

	$lv1 = getLevel37($hensa1);
	$lv5 = getLevel37($hensa5);
	$lv8 = getLevel37($hensa8);
	$lv12 = getLevel37($hensa12);
	$lv16 = getLevel37($hensa16);

	$baravg = "<div class='ab red' style='top:300px;left:".$left."px;width:1px;height:138px;'>&nbsp;</div>";
	
	function getLevel37($hensa){
		if($hensa < 35){ $lv = 1;}
		elseif($hensa >= 35 && $hensa < 45){ $lv=2;}
		elseif($hensa >= 45 && $hensa < 55){ $lv=3;}
		elseif($hensa >= 55 && $hensa < 65){ $lv=4;}
		elseif($hensa >= 65 ){ $lv=5;}
		return $lv;
	}
	$box = "
	<td class='c'></td>
	<td class='c'></td>
	<td class='c'></td>
	<td class='c'></td>
	<td class='c'></td>
	<td class='c'></td>
	<td class='c'></td>
	<td class='c'></td>
	";


	$sendflag = "";
	$txt = "詳細版";
	if($testdata[ 'ampflag' ] != 1){
		$sendflag = "
			<div id='sendbox' >※詳細版をお申込み頂くと<br />グラフをご確認頂けます。</div>
		";
		$txt = "詳細版サンプル";
	}
	

	$header = "
	<div style='float:left;width:300px;margin-top:0;'><img src='".$logo."' height=50 ></div>
	<div style='float:right;width:400px;text-align:right;padding-top:20px;'>
	経営人材度アセスメント結果<small>(個人結果報告書:".$txt.")Ver1.3</small>
	</div>
	<br clear=all />
	".$examarea;



	$contents2 = $style."
	".$header."
	<div class='mt10'>1.経営人材度検査で測定していること</div>
	<div class='box mt10'>
		本検査は、受検者が日頃発揮している５つの力「構想力」・「決断力」・「実行力」・「リーダーシップ力」・「学習力」を測定しています。
	</div>
	<div class='mt10'>2.経営人材に必要な５つの力のレベル</div>
	<table class='mt10 table2'>
		<tr>
			<td class='gray w150 c' colspan=2>5つの要素</td>
			<td class='gray w60 c'>スコア</td>
			<td class='gray w60 c'>レベル</td>
			<td class='w20 c'>&nbsp;</td>
			<td class='w80 '>20</td>
			<td class='w80 '>30</td>
			<td class='w80 '>40</td>
			<td class='w80 '>50</td>
			<td class='w80 '>60</td>
			<td class='w80 '>70</td>
			<td class='w20 c'>80</td>
		</tr>
		<tr>
			<td class='w10 gray c'>1</td>
			<td class='w140 gray c'>構想力</td>
			<td class='c'>".$hensa1."</td>
			<td class='c'>".$lv1."</td>
			".$box."
		</tr>
		<tr>
			<td class='w20 gray c'>2</td>
			<td class='w130 gray c'>決断力</td>
			<td class='c'>".$hensa5."</td>
			<td class='c'>".$lv5."</td>
			".$box."
		</tr>
		<tr>
			<td class='w10 gray c'>3</td>
			<td class='w140 gray c'>実行力</td>
			<td class='c'>".$hensa8."</td>
			<td class='c'>".$lv8."</td>
			".$box."
		</tr>
		<tr>
			<td class='w10 gray c'>4</td>
			<td class='w140 gray c'>リーダーシップ力</td>
			<td class='c'>".$hensa12."</td>
			<td class='c'>".$lv12."</td>
			".$box."
		</tr>
		<tr>
			<td class='w10 gray c'>5</td>
			<td class='w140 gray c'>学習力</td>
			<td class='c'>".$hensa16."</td>
			<td class='c'>".$lv16."</td>
			".$box."
		</tr>
	</table>
	".$baravg."
	".$bar1."
	".$bar2."
	".$bar3."
	".$bar4."
	".$bar5."
	<div class='mt10'>3.詳細領域におけるレベル</div>
	<div class='box3 mt10'>
		<img src='$mvimg_main2' style='padding-top:50px;' width=450 />
	</div>
	<div class='t11'>1-1 現状の把握</div>
	<div class='t12'>1-2 ビジョンの創造</div>
	<div class='t13'>1-3 戦略策定と組織形成</div>
	<div class='t21'>2-1 事業経営意思<br />決定への参画</div>
	<div class='t22'>2-2 多様な利害・意見の中<br />での全体最適判断</div>
	<div class='t31'>3-1 戦略の説明、周知、浸透</div>
	<div class='t32'>3-2 戦略の果断な遂行</div>
	<div class='t33'>3-3 業績へのコミット</div>
	<div class='t41'>4-1 信頼の獲得</div>
	<div class='t42'>4-2 組織リードと育成</div>
	<div class='t43'>4-3 人と組織の<br />能力開発</div>
	<div class='t51'>5-1 外部からの知見吸収<br />による自己の成長</div>
	<div class='t52'>5-2 不断の学びと経営・事業への連結</div>


	<div class='n21'>20</div>
	<div class='n22'>30</div>
	<div class='n23'>40</div>
	<div class='n24'>50</div>
	<div class='n25'>60</div>
	<div class='n26'>70</div>
	<div class='n27'>80</div>

	<div class='ex2'>
	凡例<br clear=all />
		<div class='w240 pt10'>
			<img src='/images/pdf/pdf37/blueline.png' />
			<div class='line1'>あなたの結果</div>
		</div>
		<div class='w240 pt10'>
			<img src='/images/pdf/pdf37/redline.png' />
			<div class='line2'>あなたの13要素平均値($avghensa2)</div>
		</div>
		<div class='w240 pt10'>
			<div class='line2'>受検者全体平均値(50.0)</div>
		</div>
	</div>
	".$sendflag."
	<div class='footer'>".$footer."</div>";




	$tablehead = "
	<tr>
	<th class='w100'>要素名</th>
	<th class='w60'>スコア</th>
	<th >コメント</th>
	</tr>
	";

	
	$hcmt[2] = $comment[2]['title2'];
	$hen[2] = numformat($ampdata[ 'hensa2' ]);
	$htext[2] = "
	（診断結果）<br />
		".insertStr4($comment[2][getAmpCommentKey($ampdata[ 'hensa2' ],'comment')],'<br>','50')."
		<br />
		(業務遂行上の特性）<br />
		".insertStr4($comment[2][getAmpCommentKey($ampdata[ 'hensa2' ],'other')],'<br>','50')."
	";

	$hcmt[3] = $comment[3]['title2'];
	$hen[3] = numformat($ampdata[ 'hensa3' ]);
	$htext[3] = "
	（診断結果）<br />
		".insertStr4($comment[3][getAmpCommentKey($ampdata[ 'hensa3' ],'comment')],'<br>','50')."
		<br />
		(業務遂行上の特性）<br />
		".insertStr4($comment[3][getAmpCommentKey($ampdata[ 'hensa3' ],'other')],'<br>','50')."
	";

	$hcmt[4] = $comment[4]['title2'];
	$hen[4] = numformat($ampdata[ 'hensa4' ]);
	$htext[4] = "
	（診断結果）<br />
		".insertStr4($comment[4][getAmpCommentKey($ampdata[ 'hensa4' ],'comment')],'<br>','50')."
		<br />
		(業務遂行上の特性）<br />
		".insertStr4($comment[4][getAmpCommentKey($ampdata[ 'hensa4' ],'other')],'<br>','50')."
	";

	$hcmt[6] = $comment[6]['title2'];
	$hen[6] = numformat($ampdata[ 'hensa6' ]);
	$htext[6] = "
	（診断結果）<br />
		".insertStr4($comment[6][getAmpCommentKey($ampdata[ 'hensa6' ],'comment')],'<br>','50')."
		<br />
		(業務遂行上の特性）<br />
		".insertStr4($comment[6][getAmpCommentKey($ampdata[ 'hensa6' ],'other')],'<br>','50')."
	";

	$hcmt[7] = $comment[7]['title2'];
	$hen[7] = numformat($ampdata[ 'hensa7' ]);
	$htext[7] = "
	（診断結果）<br />
		".insertStr4($comment[7][getAmpCommentKey($ampdata[ 'hensa7' ],'comment')],'<br>','50')."
		<br />
		(業務遂行上の特性）<br />
		".insertStr4($comment[7][getAmpCommentKey($ampdata[ 'hensa7' ],'other')],'<br>','50')."
	";

	$hcmt[9] = $comment[9]['title2'];
	$hen[9] = numformat($ampdata[ 'hensa9' ]);
	$htext[9] = "
	（診断結果）<br />
		".insertStr4($comment[9][getAmpCommentKey($ampdata[ 'hensa9' ],'comment')],'<br>','50')."
		<br />
		(業務遂行上の特性）<br />
		".insertStr4($comment[9][getAmpCommentKey($ampdata[ 'hensa9' ],'other')],'<br>','50')."
	";

	$hcmt[10] = $comment[10]['title2'];
	$hen[10] = numformat($ampdata[ 'hensa10' ]);
	$htext[10] = "
	（診断結果）<br />
		".insertStr4($comment[10][getAmpCommentKey($ampdata[ 'hensa10' ],'comment')],'<br>','50')."
		<br />
		(業務遂行上の特性）<br />
		".insertStr4($comment[10][getAmpCommentKey($ampdata[ 'hensa10' ],'other')],'<br>','50')."
	";


	$hcmt[11] = $comment[11]['title2'];
	$hen[11] = numformat($ampdata[ 'hensa11' ]);
	$htext[11] = "
	（診断結果）<br />
		".insertStr4($comment[11][getAmpCommentKey($ampdata[ 'hensa11' ],'comment')],'<br>','50')."
		<br />
		(業務遂行上の特性）<br />
		".insertStr4($comment[11][getAmpCommentKey($ampdata[ 'hensa11' ],'other')],'<br>','50')."
	";
	

	if($testdata[ 'ampflag' ] != 1){
		if(!$top[2] && !$under[2]){
			$hen[2] = "";
			$htext[2] = $sampletext;
		}
		if(!$top[3] && !$under[3]){
			$hen[3] = "";
			$htext[3] = $sampletext;
		}
		if(!$top[4] && !$under[4]){
			$hen[4] = "";
			$htext[4] = $sampletext;
		}
		if(!$top[6] && !$under[6]){
			$hen[6] = "";
			$htext[6] = $sampletext;
		}
		if(!$top[7] && !$under[7] ){
			$hen[7] = "";
			$htext[7] = $sampletext;
		}
		if(!$top[9] && !$under[9] ){
			$hen[9] = "";
			$htext[9] = $sampletext;
		}
		if(!$top[10] && !$under[10] ){
			$hen[10] = "";
			$htext[10] = $sampletext;
		}
		if(!$top[11] && !$under[11] ){
			$hen[11] = "";
			$htext[11] = $sampletext;
		}
	}


	$contents3 = $style."
	".$header."
	
	<div class='mt10'>5.詳細コメント</div>
	<div>【構想力】</div>
	<table class='table3'>
		".$tablehead."
		<tr>
			<td class='w90'>".$hcmt[2]."</td>
			<td >".$hen[2]."</td>
			<td >".$htext[2]."</td>
		</tr>
		<tr>
			<td class='w90'>".$hcmt[3]."</td>
			<td >".$hen[3]."</td>
			<td >".$htext[3]."</td>
		</tr>
		<tr>
		<td class='w90'>".$hcmt[4]."</td>
			<td >".$hen[4]."</td>
			<td >".$htext[4]."</td>
		</tr>
		</table>";

	$contents3 .= "
		<div>【決断力】</div>
		<table class='table3'>
		".$tablehead."
		<tr>
		<td >".$hcmt[6]."</td>
		<td >".$hen[6]."</td>
			<td >".$htext[6]."</td>
		</tr>
		<tr>
		<td >".$hcmt[7]."</td>
		<td >".$hen[7]."</td>
			<td >".$htext[7]."</td>
		</tr>
	</table>";

	$contents3 .= "
		<div>【実行力】</div>
		<table class='table3'>
		".$tablehead."
		<tr>
		<td >".$hcmt[9]."</td>
		<td >".$hen[9]."</td>
			<td >".$htext[9]."</td>
		</tr>
		<tr>
		<td >".$hcmt[10]."</td>
		<td >".$hen[10]."</td>
			<td >".$htext[10]."</td>
		</tr>
		<tr>
		<td >".$hcmt[11]."</td>
		<td >".$hen[11]."</td>
			<td >".$htext[11]."</td>
		</tr>

	</table>
	<div class='footer'>".$footer."</div>";
	




	$hcmt[13] = $comment[13]['title2'];
	$hen[13] = numformat($ampdata[ 'hensa13' ]);
	$htext[13] = "
	（診断結果）<br />
		".insertStr4($comment[13][getAmpCommentKey($ampdata[ 'hensa13' ],'comment')],'<br>','50')."
		<br />
		(業務遂行上の特性）<br />
		".insertStr4($comment[13][getAmpCommentKey($ampdata[ 'hensa13' ],'other')],'<br>','50')."
	";

	$hcmt[14] = $comment[14]['title2'];
	$hen[14] = numformat($ampdata[ 'hensa14' ]);
	$htext[14] = "
	（診断結果）<br />
		".insertStr4($comment[14][getAmpCommentKey($ampdata[ 'hensa14' ],'comment')],'<br>','50')."
		<br />
		(業務遂行上の特性）<br />
		".insertStr4($comment[14][getAmpCommentKey($ampdata[ 'hensa14' ],'other')],'<br>','50')."
	";

	$hcmt[15] = $comment[15]['title2'];
	$hen[15] = numformat($ampdata[ 'hensa15' ]);
	$htext[15] = "
	（診断結果）<br />
		".insertStr4($comment[15][getAmpCommentKey($ampdata[ 'hensa15' ],'comment')],'<br>','50')."
		<br />
		<br />
		(業務遂行上の特性）<br />
		".insertStr4($comment[15][getAmpCommentKey($ampdata[ 'hensa15' ],'other')],'<br>','50')."
	";

	$hcmt[17] = $comment[17]['title2'];
	$hen[17] = numformat($ampdata[ 'hensa17' ]);
	$htext[17] = "
	（診断結果）<br />
		".insertStr4($comment[17][getAmpCommentKey($ampdata[ 'hensa17' ],'comment')],'<br>','50')."
		<br />
		(業務遂行上の特性）<br />
		".insertStr4($comment[17][getAmpCommentKey($ampdata[ 'hensa17' ],'other')],'<br>','50')."
	";

	$hcmt[18] = $comment[18]['title2'];
	$hen[18] = numformat($ampdata[ 'hensa18' ]);
	$htext[18] = "
	（診断結果）<br />
		".insertStr4($comment[18][getAmpCommentKey($ampdata[ 'hensa18' ],'comment')],'<br>','50')."
		<br />
		(業務遂行上の特性）<br />
		".insertStr4($comment[18][getAmpCommentKey($ampdata[ 'hensa18' ],'other')],'<br>','50')."
	";

	if($testdata[ 'ampflag' ] != 1){
		if(!$top[13] && !$under[13] ){
			$hen[13] = "";
			$htext[13] = $sampletext;
		}
		if(!$top[14] && !$under[14]){
			$hen[14] = "";
			$htext[14] = $sampletext;
		}
		if(!$top[15] && !$under[15] ){
			$hen[15] = "";
			$htext[15] = $sampletext;
		}
		if(!$top[17] && !$under[17] ){
			$hen[17] = "";
			$htext[17] = $sampletext;
		}
		if(!$top[18] && !$under[18] ){
			$hen[18] = "";
			$htext[18] = $sampletext;
		}
	}



	$contents4 = $style."
	".$header."
	<div class='mt10'>5.詳細コメント</div>
	<div>【リ-ダ-シップ力】</div>

	<table class='table3'>
		".$tablehead."
		<tr>
			<td class='w90'>".$hcmt[13]."</td>
			<td >".$hen[13]."</td>
			<td >".$htext[13]."</td>
		</tr>
		<tr>
			<td class='w90'>".$hcmt[14]."</td>
			<td >".$hen[14]."</td>
			<td >".$htext[14]."</td>
		</tr>
		<tr>
			<td class='w90'>".$hcmt[15]."</td>
			<td >".$hen[15]."</td>
			<td >".$htext[15]."</td>
		</tr>
	</table>";
	
	$contents4 .= "
	<div>【学習力】</div>
	<table class='table3'>
	".$tablehead."
		<tr>
			<td class='w90'>".$hcmt[17]."</td>
			<td >".$hen[17]."</td>
			<td >".$htext[17]."</td>
		</tr>
		<tr>
			<td class='w90'>".$hcmt[18]."</td>
			<td >".$hen[18]."</td>
			<td >".$htext[18]."</td>
		</tr>
	</table>
	<div class='footer'>".$footer."</div>";

	$mpdf->WriteHTML($contents);
	//if($testdata[ 'ampflag' ] == 1){
		$mpdf->AddPage();
		$mpdf->WriteHTML($contents2);
		$mpdf->AddPage();
		$mpdf->WriteHTML($contents3);
		$mpdf->AddPage();
		$mpdf->WriteHTML($contents4);
	//}

	$date = date("Ymdhis");
	$mpdf->Output($date.'.pdf', 'D');
	exit();


	function calc_age($birth,$date)
	{
	  $d = explode("/",$date);

	  $ty = $d[0];
	  $tm = $d[1];
	  $td = $d[2];
	  list($by, $bm, $bd) = explode('/', $birth);
	  $age = $ty - $by;
	  if($tm * 100 + $td < $bm * 100 + $bd) $age--;
	  return $age;
	}
	function getAmpCommentKey($point,$type="comment"){
		if($point >= 55){
			return $type."1";
		}
		if($point >= 50 && $point < 55){
			return $type."2";
		}
		if($point >= 45 && $point < 50){
			return $type."3";
		}
		if($point < 45){
			return $type."4";
		}
	}
	function numformat($point){
		return number_format(round($point,1),1);
	}

	function insertStr4($text, $insert, $num){
    $returnText = $text;
    $text_len = mb_strlen($text, "utf-8");
    $insert_len = mb_strlen($insert, "utf-8");
    for($i=0; ($i+1)*$num<$text_len; $i++) {
        $current_num = $num+$i*($insert_len+$num);
        $returnText = preg_replace("/^.{0,$current_num}+\K/us", $insert, $returnText);
    }
    return $returnText;
	}
?>