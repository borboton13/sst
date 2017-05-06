if ARGV[0] then
	puts "Create Scaffolding definition inside: #{ARGV[0]}.rb"
	puts %x[ruby #{ARGV[0]}.rb]
	begin
	puts "Generate tables from migration ( rake db:migrate )"
	puts %x[rake.bat db:migrate]
	rescue
	end
end